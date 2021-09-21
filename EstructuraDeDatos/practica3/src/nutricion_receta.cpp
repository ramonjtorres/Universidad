#include <iostream>
#include "recetas.h"
#include "receta.h"
#include "ingredientes.h"
#include "ingrediente.h"
#include <fstream>

using namespace std;

//calcula razon proteina/hidratos de carbono
void calcularRazon(recetas all_recetas, vector<double> &razones){

  recetas::iterator it;
  for(it=all_recetas.begin(); it!=all_recetas.end(); ++it){
    razones.push_back((*it).getProteinas()/(*it).getHc());
  }
}

double max(double a, double b){
  double resultado = 0;
  if(a>b)
    resultado = a;
  else
    resultado = b;

  return resultado;
}

//Obtiene las recetas con mayor valor acumulado
recetas recetasMayorVA(recetas rall, int VA, vector<double> &razones){
    recetas rs;
    double x = 0;
    unsigned int filas = rall.size()+1;
    unsigned int columnas = VA+1;
    recetas::iterator itr = rall.begin();


    //double Matriz[filas][columnas];
    double **Matriz = new double*[filas];
    for(unsigned int i=0 ; i<filas; i++)
      Matriz[i] = new double[columnas];

    for(unsigned int i=0; i<filas; i++){
      for(unsigned int j=0; j<columnas; j++){
        Matriz[i][j]=0;
      }
    }

    //max(Matriz(0,5), Matriz(0,5-calorias)+razon)
    for(unsigned int i=1; i<filas; i++){
      for(unsigned int j=1; j<columnas; j++){
        //cout<<(*itr).getCalorias()<<"<"<<j<<endl;
        if((*itr).getCalorias()<=j){
          Matriz[i][j]=max(Matriz[i-1][j],Matriz[i-1][j-(int)(*itr).getCalorias()]+razones.at(i-1));
        }else if(Matriz[i-1][j]!=0)
          Matriz[i][j]=Matriz[i-1][j];
      }
      ++itr;
    }


//impresión de la matriz
/*    for(unsigned int i=0; i<rall.size()+1; i++){
      cout<<endl;
      for(int j=0; j<VA+1; j++){
        cout<<Matriz[i][j]<<" ";
      }
    }
    cout<<endl;*/


    filas--;
    columnas--;
    x = Matriz[filas][columnas];
    recetas::iterator itr2 = rall.end();
    --itr2;
    while(x!=0){
      if(x!=Matriz[filas-1][columnas]){
        rs.insertar(*itr2);
        columnas = columnas-(int)(*itr2).getCalorias();
        --itr2;
        filas--;
        x=Matriz[filas][columnas];
      }
      else{
        filas--;
        x = Matriz[filas][columnas];
        --itr2;
      }
    }

    for (unsigned int i = 0; i < rall.size()+1; i++)
    	delete [] Matriz[i];

    delete [] Matriz;

    return rs;
}

void MuestraParametros(){

	cout<<"1.- Dime el nombre del fichero con las recetas"<<endl;
    cout<<"2.- Dime el nombre del fichero con los ingredientes"<<endl;
    cout<<"3.- Dime el número máximo de calorías"<<endl;
}

int main(int argc, char *argv[])
{
  if(argc!=4){

	  MuestraParametros();
	  return 0;
}

string nf = argv[1];
string ng = argv[2];
ifstream f(nf);
ifstream g(ng);

if(!f){

    cout << "No puedo abrir " << nf << endl;
    return 0;
}

if(!g){

    cout << "No puedo abrir " << ng << endl;
    return 0;
}

f.seekg(0);
recetas all_recetas;
f >> all_recetas;

g.seekg(0);
ingredientes all_ingre;
g >> all_ingre;

recetas::iterator its = all_recetas.begin();

for(its = all_recetas.begin(); its != all_recetas.end(); ++its){

    cout << "\n\nValores nutricionales de la receta: \n" << endl;

    cout << *its << "son: \n" << endl;

    (*its).aniadirNutrientes(all_ingre);

    cout << "Calorias " << (*its).getCalorias() << " Hidratos de Carb " << (*its).getHc() << " Proteinas " << (*its).getProteinas()
         << " Grasas " << (*its).getGrasas() << " Fibra " << (*its).getFibra() << endl;
}

cout << "\n Pulsa una tecla para continuar...." << endl;
cin.get();

cout << "\nLas recetas escogidas son: \n" << endl;

int VA = stoi(argv[3]);
double numCalorias = 0;
double numProteinas = 0;
vector<double> razones;
calcularRazon(all_recetas,razones);
recetas rsMayorVA = recetasMayorVA(all_recetas, VA, razones);

for(its = rsMayorVA.begin(); its != rsMayorVA.end(); ++its){

    cout << *its << endl;
    numCalorias += (*its).getCalorias();
    numProteinas += (*its).getProteinas();
}

cout << "Calorías Totales: " << numCalorias << "| Proteínas Totales: " << numProteinas << endl;
}

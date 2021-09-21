#include <iostream>
#include "math.h"
#include "ingrediente.h"
#include "ingredientes.h"
#include <fstream>
using namespace std;

double media(VD <double> valores){

    double suma = 0.0, media;

    for (int i = 0; i < valores.size(); i++){

        suma += valores[i];
    }

    media = suma / valores.size();

    return media;
}

double varianza(VD<double> valores){
  
  int n = valores.size();
  double pro = media(valores);
  double var = 0;

  for(int i = 0; i< valores.size(); i++)
    var += pow((valores[i] - pro), 2);

  return var / n;
}

double desviacion(VD <double> valores, double var){
  
  if(var == 0)
    var = varianza(valores);

  return sqrt(var);
}


ingrediente maximo(VD <double> valores, ingredientes is){

  ingrediente ing = is[0];
  double max = valores[0];

  for (int i = 0; i < is.size(); i++){
    if (valores[i] > max){
      ing = is[i];
      max = valores[i];
    }
  }
 
  cout<<endl<<endl<<endl;
  return ing;
}

ingrediente minimo(VD <double> valores, ingredientes is){

    ingrediente ing = is[0];
    double min = valores[0];

    for (int i = 0; i < is.size(); i++){
        if (valores[i] < min){
            ing = is[i];
            min = valores[i];
        }
    }
    return ing;
  }

void MuestraParametros(){

	cout<<"1.- Dime el nombre del fichero con los ingredientes"<<endl;
  cout<<"2.- Dime el nombre del tipo de ingrediente"<<endl;
}

int main(int argc, char *argv[])
{
  if(argc!=3){

	  MuestraParametros();
	  return 0;
}

string nf = argv[1];
ifstream f(nf);

if(!f){

    cout << "No puedo abrir " << nf << endl;
    return 0;
}

string linea;
getline(f, linea);

f.seekg(0);
ingredientes all_ingre;
f >> all_ingre;

VD<string> tipos = all_ingre.getTipos();

cout << "Los tipos de alimentos son: " << endl;

for(int i = 0; i < tipos.size(); ++i){

    cout << tipos[i] << endl;
}

cout << "\n Pulsa una tecla para continuar...." << endl;
cin.get();

string tipo = argv[2];
ingredientes ingre_tipo = all_ingre.getIngredienteTipo(tipo);
cout << "Los ingredientes de tipo " << tipo << " son: " << endl << ingre_tipo << endl;

cout << "\n Pulsa una tecla para continuar...." << endl;
cin.get();

VD <double> valoresC, valoresHc, valoresP, valoresG, valoresF;
double mediaC, mediaHc, mediaP, mediaG, mediaF;
double desvC, desvHc, desvP, desvG, desvF;
double varC, varHc, varP, varG, varF;
ingrediente maxC, maxHc, maxP, maxG, maxF;
ingrediente minC, minHc, minP, minG, minF;

//Se insertan los valores de cada atributo
for(int i = 0; i < ingre_tipo.size(); i++){

    valoresC.insertar(ingre_tipo[i].getCalorias(), i);
    valoresHc.insertar(ingre_tipo[i].getHc(), i);
    valoresP.insertar(ingre_tipo[i].getProteinas(), i);
    valoresG.insertar(ingre_tipo[i].getGrasas(), i);
    valoresF.insertar(ingre_tipo[i].getFibra(), i);
}

//Medias

mediaC = media(valoresC);
mediaHc = media(valoresHc);
mediaP = media(valoresP);
mediaG = media(valoresG);
mediaF = media(valoresF);

//Varianza

varC = varianza(valoresC);
varHc = varianza(valoresHc);
varP = varianza(valoresP);
varG = varianza(valoresG);
varF = varianza(valoresF);

//Desviaciones

desvC = desviacion(valoresC,varC);
desvHc = desviacion(valoresHc,varHc);
desvP = desviacion(valoresP,varP);
desvG = desviacion(valoresG,varG);
desvF = desviacion(valoresF,varF);

//Maximos

maxC = maximo(valoresC, ingre_tipo);
maxHc = maximo(valoresHc, ingre_tipo);
maxP = maximo(valoresP, ingre_tipo);
maxG = maximo(valoresG, ingre_tipo);
maxF = maximo(valoresF, ingre_tipo);

//Minimos

minC = minimo(valoresC, ingre_tipo);
minHc = minimo(valoresHc, ingre_tipo);
minP = minimo(valoresP, ingre_tipo);
minG = minimo(valoresG, ingre_tipo);
minF = minimo(valoresF, ingre_tipo);


cout << "Estadistica_____________________________" << endl;

cout << "Tipo de Alimento " << tipo << endl;

cout << "Promedio +- Desviacion" << endl;

cout << "Calorias          " << "Hidratos de Carb      " << "Proteinas        " << "Grasas        " << "Fibra" << endl;

cout << mediaC << "+-" << desvC << "      " << mediaHc << "+-" << desvHc << "      " << mediaP << "+-" << desvP << "    " << mediaG << "+-" << desvG << "    " << mediaF << "+-" << desvF << endl;

cout << "Maximos Valores" << endl;

cout << "Calorias (Alimento)       " << "Hidratos de Carb (Alimento)      " << "Proteinas (Alimento)     " << "Grasas (Alimento)    " << "Fibra (Alimento)" << endl;

cout << maxC.getCalorias() <<" "<<maxC.getNombre() << "       " << maxHc.getHc() <<" "<< maxHc.getNombre() << "                " << maxP.getProteinas() <<" "<< maxP.getNombre() << "       " << maxG.getGrasas() <<" "<< maxG.getNombre() << "        " << maxF.getFibra() <<" "<< maxF.getNombre() << " " << endl;

cout << "Minimos Valores" << endl;

cout << "Calorias (Alimento)       " << "Hidratos de Carb (Alimento)      " << "Proteinas (Alimento)     " << "Grasas (Alimento)    " << "Fibra (Alimento)" << endl;

cout << minC.getCalorias() <<" "<<minC.getNombre() << "    " << minHc.getHc() <<" "<< minHc.getNombre() << "                " << minP.getProteinas() << " " << minP.getNombre() << "                 " << minG.getGrasas() <<" "<< minG.getNombre() << " " << minF.getFibra() <<" "<< minF.getNombre() << " " << endl;

}

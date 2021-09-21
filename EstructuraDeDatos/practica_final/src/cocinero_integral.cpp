#include "recetas.h"
#include "color.h"
#include<iostream>
#include<fstream>
#include<algorithm>

using namespace std;

ingredientes obtenerIngredientesReceta(receta r, ingredientes all_ings){

  ingredientes ings;
  list<pair<string, unsigned int>> ings_receta = r.getIngredientes();
  list<pair<string, unsigned int>>::iterator it;
  ingrediente ing;

  for(it = ings_receta.begin(); it != ings_receta.end(); ++it){

    ing = all_ings.get((*it).first);
    ings.Insertar(ing);

  }

  return ings;

}

int main(int argc, char *argv[]){

  if(argc!=5){
    cout << "Dime el fichero con las acciones" << endl;
    cout << "Dime el fichero con las recetas" << endl;
    cout << "Dime el fichero con los ingredientes" << endl;
    cout << "Dime el fichero con las instrucciones" << endl;
    return 0;
  }

  string na = argv[1];
  ifstream a(na);

  if(!a){
    cout << "No se puede abrir el archivo" << na << endl;
    return 0;
  }

  string nr = argv[2];
  ifstream r(nr);

  if(!r){
    cout << "No se puede abrir el archivo" << nr << endl;
    return 0;
  }

  string ni = argv[3];
  ifstream i(ni);

  if(!i){
    cout << "No se puede abrir el archivo" << ni << endl;
    return 0;
  }

  string nf = argv[4];

  acciones ac;
  recetas rects;
  ingredientes ings;
  instrucciones inst;

  a >> ac;
  r >> rects;
  i >> ings;

  recetas::iterator itr;

  cout << endl;

  for(itr = rects.begin(); itr != rects.end(); ++itr){

      cout << FBLU("CODE:") << (*itr).getCode()  << FBLU(" NOMBRE: ") << (*itr).getNombre() << FBLU(" PLATO:") << (*itr).getPlato() << endl;
  }

  cout << endl << "Pulse una tecla para continuar" << endl;
  cin.get();

  cout << "Dime el codigo de una receta:" << endl;
  string c;

  cin >> c;

  if (rects[c].getNombre()!="Receta"){
	  cout << FBLU("CODE:") << rects[c].getCode()  << FBLU(" NOMBRE: ") << rects[c].getNombre() << FBLU(" PLATO:") << rects[c].getPlato() << endl;
  }
  else{
	  cout << "La receta con codigo " << c << " no existe" << endl;
  }

  list<pair<string, unsigned int>> lista_rings;
  list<pair<string, unsigned int>>::iterator itri;

  receta rc = rects[c];

  lista_rings = rc.getIngredientes();

  cout << endl << UNDL(BOLD("Ingredientes:")) << endl << endl;

  for(itri = lista_rings.begin(); itri != lista_rings.end(); ++itri){

      cout << "         " << (*itri).first << " " << (*itri).second << endl;

  }

  rc.aniadirNutrientes(ings);

  cout << endl << UNDL(BOLD("Información Nutricional:")) << endl << endl;

  cout << "         Calorías:" << rc.getCalorias() << endl;
  cout << "         Hidratos de Carbono:" << rc.getHc() << endl;
  cout << "         Grasas:" << rc.getGrasas() << endl;
  cout << "         Proteína:" << rc.getProteinas() << endl;
  cout << "         Fibra:" << rc.getFibra() << endl;

  ifstream f(nf + c + "m.txt");

  ingredientes ingc = obtenerIngredientesReceta(rc, ings);

  inst.setAcciones(ac);
  inst.setIngredientes(ingc);

  f >> inst;

  rc.setInstrucciones(inst, ac);

  instrucciones instr = rc.getInstrucciones();

  cout << endl << UNDL(BOLD("Pasos a seguir:")) << endl << endl;

  cout << instr;

  cout << endl << "Pulse una tecla para continuar" << endl;

  cout << endl << "Vamos a realizar la fusión de 2 recetas" << endl << endl;

  cout << "Dime el codigo de la primera receta a fusionar:" << endl;
  string r1;

  cin >> r1;

  cout << endl << "Dime el codigo de la segunda receta a fusionar:" << endl;
  string r2;

  cin >> r2;

  receta rF;

  if (rects[r1].getNombre()!="Receta" && rects[r2].getNombre()!="Receta"){

	  string codF = "F_" + rects[r1].getCode() + "_" + rects[r2].getCode();
    string nombreF = rects[r1].getNombre() + " y " + rects[r2].getNombre();

    rF.setCode(codF);
    rF.setPlato(1);
    rF.setNombre(nombreF);

    cout << endl << FBLU("CODE:") << codF << FBLU(" NOMBRE: ") << "Fusion " << nombreF << FBLU(" PLATO:") << rects[r1].getPlato() << endl;
  }
  else{
	  cout << "Las recetas con codigo " << r1 << " ó " << r2 << " no existen" << endl;
  }

  list<pair<string, unsigned int>> lista_rings1, lista_rings2;
  list<pair<string, unsigned int>>::iterator itri1, itri2, l;

  lista_rings1 = rects[r1].getIngredientes();
  lista_rings2 = rects[r2].getIngredientes();

  //Sumamos la cantidad de nutrientes iguales
  for(itri1 = lista_rings1.begin(); itri1 != lista_rings1.end(); ++itri1){

    for(itri2 = lista_rings2.begin(); itri2 != lista_rings2.end(); ++itri2){

      if((*itri1).first == (*itri2).first){

            (*itri1).second += (*itri2).second;
      }
    }
  }

  //Añadimos los ingredientes distintos eliminando los repetidos
  bool igual = false;
  for(itri2 = lista_rings2.begin(); itri2 != lista_rings2.end(); ++itri2){
    igual = false;
    for(itri1 = lista_rings1.begin(); itri1 != lista_rings1.end(); ++itri1){
      if((*itri1).first==(*itri2).first)
        igual = true;
    }
    if(!igual)
      lista_rings1.push_back(*itri2);
  }

  //Añadimos los nombres de los ingredientes a la receta Fusion
  for(itri1 = lista_rings1.begin(); itri1 != lista_rings1.end(); ++itri1){

      rF.set_ingrediente(*itri1);
  }

  rF.aniadirNutrientes(ings);

  cout << endl << UNDL(BOLD("Ingredientes:")) << endl << endl;

  for(itri1 = lista_rings1.begin(); itri1 != lista_rings1.end(); ++itri1){

      cout << "         " << (*itri1).first << " " << (*itri1).second << endl;

  }

  cout << endl << UNDL(BOLD("Información Nutricional:")) << endl << endl;

  cout << "         Calorías: " << rF.getCalorias() << endl;
  cout << "         Hidratos de Carbono: " << rF.getHc() << endl;
  cout << "         Grasas: " << rF.getGrasas() << endl;
  cout << "         Proteína: " << rF.getProteinas() << endl;
  cout << "         Fibra: " << rF.getFibra() << endl;

  ifstream h(nf + r1 + "m.txt");

  //OBTENEMOS EL PRIMER ÁRBOL DE INSTRUCCIONES DE LA FUSIÓN

  ingc = obtenerIngredientesReceta(rects[r1], ings);
  inst.setIngredientes(ingc);

  ArbolBinario<string> ab1, ab2;

  h >> inst;
  ab1 = inst.getArbolInstrucciones();

  //OBTENEMOS EL SEGUNDO ÁRBOL DE INSTRUCCIONES DE LA FUSIÓN

  ifstream w(nf + r2 + "m.txt");

  ingc = obtenerIngredientesReceta(rects[r2], ings);
  inst.setIngredientes(ingc);

  w >> inst;

  ab2 = inst.getArbolInstrucciones();

  //REALIZAMOS LA FUSIÓN EN UN SOLO ÁRBOL

  ArbolBinario<string> abF = ArbolBinario<string>("Acompañar");

  abF.Insertar_Hi(abF.getRaiz(), ab1);
  abF.Insertar_Hd(abF.getRaiz(), ab2);

  instrucciones instF;

  instF.setInstrucciones(abF);

  cout << endl <<  UNDL(BOLD("Pasos a seguir:")) << endl << endl;

  cout << instF << endl;

}

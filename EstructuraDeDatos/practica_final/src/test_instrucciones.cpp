#include <iostream>
#include "instrucciones.h"
#include "acciones.h"
#include "ingredientes.h"
#include <fstream>

using namespace std;

int main(int argc, char *argv[]){

  if(argc!=4){

    cout << "Dime el fichero con las instrucciones" << endl;
    cout << "Dime el fichero con las acciones" << endl;
    cout << "Dime el fichero con los ingredientes" << endl;
    
    return 0;
  }

  //Probamos operador de entrada

  string nf = argv[1];
  ifstream f(nf);

  string ng = argv[2];
  ifstream g(ng);

  string ni = argv[3];
  ifstream i(ni);

  if(!f){

    cout << "No se puede abrir el archivo de instrucciones" << nf << endl;

    return 0;
  }

  if(!g){

    cout << "No se puede abrir el archivo de acciones" << ng << endl;

    return 0;
  }

  //Probamos operador de entrada
  
  instrucciones ins;
  acciones ac;
  g >> ac;

  ins.setAcciones(ac);

  ingredientes ing;

  i >> ing;

  ins.setIngredientes(ing);

  f >> ins;

  //Probamos operador de salida

  cout << endl << endl << "Operador de salida: " << endl << ins << endl;
}
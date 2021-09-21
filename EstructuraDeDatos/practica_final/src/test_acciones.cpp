#include <iostream>
#include "acciones.h"
#include <fstream>

using namespace std;

int main(int argc, char *argv[]){

  if(argc!=2){
    cout<<"Dime el fichero con las acciones"<<endl;
    return 0;
  }

  //Probamos operador de entrada y salida;

  string nf = argv[1];
  ifstream f(nf);
  if(!f){
    cout<<"No se puede abrir el archivo"<<nf<<endl;
    return 0;
  }

  cout<<"Vamos a utilizar el operador de entrada"<<endl;
  acciones ac;
  f>>ac;
  cout<<"Ahora mostramos la salido con el operador de salida: "<<endl<<ac<<endl;
}

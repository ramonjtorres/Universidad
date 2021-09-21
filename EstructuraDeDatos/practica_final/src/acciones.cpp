#include "acciones.h"

using namespace std;

//Constructor

acciones::acciones(){}

//Insertar accion
void acciones::insertar_accion(string accion, unsigned int ariedad){
  datos[accion]=ariedad;
}

unsigned int acciones::getAriedad(string accion){

  return datos[accion];
}

//Operador <<
ostream & operator <<(ostream& os, acciones& a){
  acciones::iterator it;
  for(it=a.begin(); it!=a.end(); ++it){
    os << (*it) <<endl;
  }
  return os;
}

//Operador >>
istream & operator >>(istream& is, acciones& a){

  string linea=" ";
  getline(is,linea);

  do{ //no estoy seguro si este while cogerá hasta que no haya  mas lineas escritas
    unsigned int ar=0;
    string acc="";
    //cout<<linea<<endl;

    //string
    int pos = linea.find(" ");
    acc = linea.substr(0,pos);
    linea = linea.substr(pos+1);

    //unsigned instancia
    ar = atoi(linea.c_str());

    a.insertar_accion(acc,ar);
    getline(is,linea);

  }while(linea!="\0");

  return is;

}

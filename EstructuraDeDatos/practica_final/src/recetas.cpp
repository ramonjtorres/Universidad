#include "recetas.h"

using namespace std;

//metodo getreceta
  const receta recetas::getReceta(string code) const{
  cout<<"Codigo a busccar"<<code<<" Long: "<<code.size()<<endl;
  map<string, receta>::const_iterator it;
  it = datos.find(code);
  if (it==datos.end()){
    cout<<"No lo ha encontrado "<<endl;
    return receta();
  }
  return it->second;
}

//metodo erase

void recetas::borrar(string code){
  datos.erase(code);
}

//metodo insertar

void recetas::insertar( receta &r){
  datos[r.getCode()] = r;
}

//operador salida
ostream& operator<<(ostream &os, recetas &recets){
  
  recetas::iterator it;
  
  for(it=recets.begin(); it!=recets.end(); ++it){
    os << (*it) <<endl;
  }
  
  return os;
}
//operador de entrada

istream& operator>>(istream &is, recetas &recets){
  receta r;
  string linea;
  while(is >> r){
    recets.insertar(r);
  }
  return is;
}

#include<iostream>
#include<string>
#include<cstdlib>
#include "ingrediente.h"

using namespace std;

//Constructor por defecto de la clase
ingrediente::ingrediente(){

    nombre = "Ingrediente";
    calorias = 0;
    Hc = 0;
    proteinas = 0;
    grasas = 0;
    fibra = 0;
    tipo = "Alimento";
}


//Constructor de la clase
ingrediente::ingrediente(string n, int c, float hc, float p, float g, float f, string t){

    nombre = n;
    calorias = c;
    Hc = hc;
    proteinas = p;
    grasas = g;
    fibra = f;
    tipo = t;
}

//Constructor de copia de la clase
ingrediente::ingrediente(const ingrediente & original){

    nombre = original.nombre;
    calorias = original.calorias;
    Hc = original.Hc;
    proteinas = original.proteinas;
    grasas = original.grasas;
    fibra = original.fibra;
    tipo = original.tipo;
}

//Consultor del nombre del ingrediente
string ingrediente::getNombre(){

    return nombre;
}

//Consultor de las calorias (/100g) del ingrediente
double ingrediente::getCalorias(){

    return calorias;
}

//Consultor del % de Hidratos de carbono del ingrediente
double ingrediente::getHc(){

    return Hc;
}

//Consultor del % de proteinas del ingrediente
double ingrediente::getProteinas(){

    return proteinas;
}

//Consultor del % de grasas del ingrediente
double ingrediente::getGrasas(){

    return grasas;
}

//Consultor del % de fibra del ingrediente
double ingrediente::getFibra(){

    return fibra;
}

//Consultor del tipo de alimento del ingrediente
string ingrediente::getTipo(){

    return tipo;
}

//Modificador del nombre del ingrediente
void ingrediente::setNombre(string n){

    nombre = n;
}

//Modificador de las calorias (/100g) del ingrediente
void ingrediente::setCalorias(int c){

    calorias = c;
}

//Modificador del % de Hidratos de carbono del ingrediente
void ingrediente::setHc(float hc){

    Hc = hc;
}

//Modificador del % de proteinas del ingrediente
void ingrediente::setProteinas(float p){

    proteinas = p;
}

//Modificador del % de grasas del ingrediente
void ingrediente::setGrasas(float g){

    grasas = g;
}

//Modificador del % de fibra del ingrediente
void ingrediente::setFibra(float f){

    fibra = f;
}

//Modificador del tipo de alimento del ingrediente
void ingrediente::setTipo(string t){

    tipo = t;
}

//Operador <<
ostream & operator <<(ostream& os, const ingrediente& i){

    return os << i.nombre << ';' << i.calorias << ';' << i.Hc << ';' << i.proteinas <<
    ';' << i.grasas << ';' << i.fibra << ';' << i.tipo ;
}

//Operador >>
istream & operator >>(istream& is, ingrediente& i){

	string linea;
	getline(is,linea);
    //nombre
	string nom;
	int pos = linea.find(";");
	nom = linea.substr(0,pos);
	linea = linea.substr(pos+1);
  i.setNombre(nom);
  //calorias
  string c;
  pos = linea.find(";");
  c=linea.substr(0,pos);
  int cal = atoi(c.c_str());
  linea = linea.substr(pos+1);
  i.setCalorias(cal);
  //hidratos de carbono
  string hc;
  pos = linea.find(";");
  hc = linea.substr(0,pos);
  float hid = atof(hc.c_str());
  linea = linea.substr(pos+1);
  i.setHc(hid);
  //Proteinas
  string p;
  pos = linea.find(";");
  p = linea.substr(0,pos);
  float prot = atof(p.c_str());
  linea = linea.substr(pos+1);
  i.setProteinas(prot);
  //grasas
  string g;
  pos = linea.find(";");
  g = linea.substr(0,pos);
  float gras = atof(g.c_str());
  linea = linea.substr(pos+1);
  i.setGrasas(gras);
  //fibra
  string f;
  pos = linea.find(";");
  f = linea.substr(0,pos);
  float fib = atof(f.c_str());
  linea = linea.substr(pos+1);
  i.setFibra(fib);
  //tipos
  pos = linea.find("\r");
  linea = linea.substr(0,pos);
  i.setTipo(linea);

  return is;

}

//Operador ==

bool ingrediente::operator ==( ingrediente& i){
	if(nombre == i.getNombre() && tipo == i.getTipo())
		return true;
	else return false;
}

//Operador <
bool ingrediente::operator <( ingrediente& i){
	bool resultado = false;
  if(nombre < i.getNombre()){
    resultado = true;
  }else if(nombre == i.getNombre()){
    if(tipo <= i.getTipo()){
      resultado = true;
    }
  }
  return resultado;
}

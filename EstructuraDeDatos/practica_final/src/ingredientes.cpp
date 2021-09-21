#include<iostream>
#include "ingredientes.h"
using namespace std;

//Constructor de clase por defecto
ingredientes::ingredientes(){}

//Busqueda binaria para ingredientes
mypair ingredientes::BBinariaIngrediente(int inicio,int fin,ingrediente x){

	mypair p;
	p.pos = -1;
	p.esta = false;

	while((inicio < fin) && (!p.esta)){
		int mitad = (fin + inicio) / 2;

		if(datos[mitad] == x){
			p.esta = true;
			p.pos = mitad;

		}else if(datos[mitad] < x){
			inicio = mitad +1;

		}else
			fin = mitad;
	}
	if(!p.esta)
		p.pos = inicio;

	return p;
}

//Busqueda binaria para indices
mypair ingredientes::BBinariaIndice(int inicio, int fin, ingrediente x){

	mypair p;
	p.pos = -1;
	p.esta = false;

	while((inicio < fin) && (!p.esta)){

	 	int mitad = (fin + inicio) / 2;
		if(datos[indice[mitad]] == x){
			p.esta = true;
			p.pos = mitad;
		}
		else if(datos[indice[mitad]].getTipo() < x.getTipo()){
			inicio = mitad + 1;
		}else if((datos[indice[mitad]].getTipo() == x.getTipo()) && (datos[indice[mitad]].getNombre() < x.getNombre())){
      inicio = mitad + 1;
    }else
			fin = mitad;
	}
	if(!p.esta)
		p.pos = inicio;

	return p;
}

void ingredientes::Insertar(ingrediente &i){
	mypair pd, pi;
	vector<ingrediente>::iterator it = datos.begin();
	vector<int>::iterator ip = indice.begin();

	pd = BBinariaIngrediente(0, datos.size(), i);
	pi = BBinariaIndice(0, indice.size(), i);

	if(!pi.esta){
				for (unsigned int i = 0; i< indice.size();i++){
					if (indice[i]>=pd.pos)
						indice[i]++;
			}
	}
	if(!pd.esta){//en caso de que no esté

		advance(it,pd.pos);
		advance(ip,pi.pos);
		datos.insert(it, i); //Insertamos el nuevo ingrediente en datos
		indice.insert(ip, pd.pos); //Insertamos el nuevo indice
	}
}

//Borrar un ingrediente
void ingredientes::borrar(string s){
	ingrediente i = get(s);
	mypair pd, pi;
	vector<ingrediente>::iterator it = datos.begin();
	vector<int>::iterator ip = indice.begin();

	pd = BBinariaIngrediente(0, datos.size(), i);
	pi = BBinariaIndice(0, indice.size(), i);

	if(pi.esta){
		for(unsigned int i = 0; i<indice.size(); i++){
			if(indice[i]>=pd.pos)
			indice[i]--;
		}
	}
	if(pd.esta){
		advance(it, pd.pos);
		advance(ip, pi.pos);
		datos.erase(it);
		indice.erase(ip);
	}
}

//devuelve el tamaño de datos
int ingredientes::size(){
	return datos.size();
}

//Devuelve el ingrediente en la posición i según el orden del nombre
ingrediente ingredientes::obtIngNom(int i){
	ingrediente ing = datos[i];
	return ing;
}

//Devuelve la información de un ingrediente dando su nombre
ingrediente ingredientes::get(string &n){
	int pos = 0;
	string inf = "";
	for(unsigned int i = 0; i < datos.size(); i++){
		if( datos[i].getNombre() == n){
			pos = i;
		}
	}
	return datos[pos];
}

//Obtiene en i todos los ingredientes ordenados por tipo
void ingredientes::ImprimirPorTipo(){
	for(unsigned int j = 0; j< datos.size(); j++){
		cout<<datos[indice[j]]<<endl;
	}
}

//Obtiene en i todos los ingredientes de un tipo
 ingredientes ingredientes::getIngredienteTipo(string tipo){

	ingredientes i;
 	string tipo2;
 	for(unsigned int j = 0; j< datos.size(); j++){
 		tipo2=datos[j].getTipo();
 		if(tipo == tipo2){
 			i.Insertar(datos[j]);
		}
	}
	return i;
}

bool Esta(string Tipo, vector<string>vd){

	bool resultado = false;

	for(unsigned int i = 0; i < vd.size(); i++){

		if(vd[i] == Tipo){

			resultado = true;
		}
	}

	return resultado;
}

//Obtiene en t todos los tipos
vector<string> ingredientes::getTipos(){

	vector<string>tipos;

	for(unsigned int i = 0; i < datos.size(); i++){
		if(!Esta(datos[indice[i]].getTipo(),tipos)){
			tipos.push_back(datos[indice[i]].getTipo());
		}
	}

	return tipos;
}

//Modificar el ingrediente de la posicion pos por otro ingrediente
void ingredientes::modIng(ingrediente& i, int pos){
	borrar(datos[pos].getNombre());
	Insertar(i);
}

//Operator []
const ingrediente& ingredientes::operator[] (int i) const{
	return datos[i];
}

//Operator []
ingrediente & ingredientes::operator[] (int i){
	return datos[i];
}

//Operador >>
istream & operator >>(istream& is, ingredientes& i){
	string linea;
	getline(is,linea);
	ingrediente ing;
	while(is >> ing){
		i.Insertar(ing);
	}
	return is;
}

//Operador <<
ostream& operator <<(ostream& os, ingredientes& i){
	for (int j = 0; j< i.size(); j++)
		os <<i[j] <<endl;
	return os;
}


#include "receta.h"

using namespace std;

  //Constructor de la clase
  receta::receta(){

    code = '0';
    plato = 0;
    nombre = "Receta";
    calorias = 0;
    hc = 0;
    proteinas = 0;
    grasas = 0;
    fibra = 0;
  }

  //Modificador de código
  void receta::setCode(string cod){

    code = cod;
  }

  //Modificador de plato
  void receta::setPlato(unsigned int num){

    plato = num;
  }

  //Modificador de nombre
  void receta::setNombre(string nom){

    nombre = nom;
  }

  //Consultor de code
  string receta::getCode(){

    return code;
  }

  //Consultor de plato
  unsigned int receta::getPlato(){

    return plato;
  }

  //Consultor de nombre
  string receta::getNombre(){

    return nombre;
  }

  //Consultor de ingredientes
  list<pair<string, unsigned int>> receta::getIngredientes(){

    return ings;
  }

  //Consultor de calorias
  double receta::getCalorias(){

    return calorias;
  }

  //Consultor de Hidratos de carbono
  double receta::getHc(){

    return hc;
  }

  //Consultor de grasas
  double receta::getGrasas(){

    return grasas;
  }

  //Consultor de proteinas
  double receta::getProteinas(){

    return proteinas;
  }

  //Consultor de fibra
  double receta::getFibra(){

    return fibra;
  }

  //Consultor del numero de ingredientes
  int receta::ningredientes(){

    return ings.size();
  }

  void receta::set_ingrediente(pair<string, unsigned int> &a){
    ings.push_back(a);
  }

  void receta::revertir_lista(){
    ings.reverse();
  }

  void receta::clear(){
    ings.clear();
  }

  void receta::aniadirNutrientes(ingredientes &is){

    list<pair<string, unsigned int>>::iterator it;

    for(it = ings.begin(); it != ings.end(); ++it){

        for(int i = 0; i < is.ingredientes::size(); i++){

            if(is[i].getNombre() == (*it).first){
                calorias += is[i].getCalorias()*(((*it).second)/100.0);
                hc += is[i].getHc()*((*it).second/100.0);
                proteinas += is[i].getProteinas()*((*it).second/100.0);
                grasas += is[i].getGrasas()*((*it).second/100.0);
                fibra += is[i].getFibra()*((*it).second/100.0);
            }
        }
    }
  }

  //Operador <<
  ostream & operator <<(ostream& os, const receta& r){

      os << r.code << ';' << r.plato << ';' << r.nombre << ';';
      receta::const_iterator it;
      for (it=r.begin();it!=r.end();++it){
    	  os<<(*it).first<<"\t"<<(*it).second<<"\t";
       }
       os<<"\n";
      return os;
  }

  //Operador >>
  istream & operator >>(istream& is, receta& r){

    r.clear();
    string linea;
    getline(is,linea);
    unsigned int pos = 0;
    if(linea.size()!=0){
      //code
      string cod;
      pos = linea.find(";");
      cod = linea.substr(0,pos);
      linea = linea.substr(pos+1);
      r.setCode(cod);
      //plato
      string num1;
      unsigned int num;
      pos = linea.find(";");
      num1 = linea.substr(0,pos);
      num = atoi(num1.c_str());
      linea = linea.substr(pos+1);
      r.setPlato(num);

      //nombre
      string nom=" ";
      pos = linea.find(";");
      nom = linea.substr(0,pos);
      linea = linea.substr(pos);
      r.setNombre(nom);

      //pair
      pair<string, unsigned int> ingredient;
      string ing,s;
      int ui = 0;
      string fragmento =" ";

      for(string::iterator it = linea.end();  linea.size() != 0; --it){

        if((*it)==';'){

          pos = linea.rfind(";");
          fragmento = linea.substr(pos,linea.size());
          linea = linea.substr(0,pos);

          for(string::iterator it2 = fragmento.end(); fragmento.begin()!=it2 && fragmento.size()!= 0 ; --it2){

            if ((*it2)==' ' ){

              pos = fragmento.rfind(" ");
              s = fragmento.substr(pos,fragmento.size());
              ui = atoi(s.c_str());
              fragmento = fragmento.substr(0,pos);
              ing = fragmento.substr(1,fragmento.size());
              pos = fragmento.find(";");
              fragmento = fragmento.substr(0,pos);
              ingredient.first = ing;
              ingredient.second = ui;
              r.set_ingrediente(ingredient);
            }
          }
        }
      }

      r.revertir_lista();
    }

    return is;

  }

  //Operador ==
  bool receta::operator ==( receta& r){
    if(nombre == r.getNombre() && code == r.getCode())
      return true;
    else return false;
  }

  //Operador <
  bool receta::operator <( receta& r){
    bool resultado = false;
    if(nombre < r.getNombre()){
      resultado = true;
    }else if(nombre == r.getNombre()){
      if(code <= r.getCode()){
        resultado = true;
      }
    }
    return resultado;
  }

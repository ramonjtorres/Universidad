#include "instrucciones.h"
#include<stack>

using namespace std;

//Constructor

instrucciones::instrucciones(){}

//set de Acciones
void instrucciones::setAcciones(acciones ac){

    acc = ac;
}

//set del Árbol de Instrucciones
void instrucciones::setInstrucciones(ArbolBinario<string> ab){

    datos = ab;
}

//set de Ingredientes de la receta
void instrucciones::setIngredientes(ingredientes ings){

    is = ings;
}

//Consultor Árbol de Instrucciones
ArbolBinario<string> instrucciones::getArbolInstrucciones(){

    return datos;
}

//Obtiene el ingrediente de la linea
bool instrucciones::obtenerIngrediente(string & linea, string & ing){

    if(linea=="\0")
      return false;
    else{
      int pos = linea.find(" ");
      int pos2 = linea.find("\r");
      if(pos == -1){
        if(ing == " "){
          ing=linea.substr(0,pos2);
        }
        else{
          ing += linea.substr(0,pos2);
        }

        if(is.get(ing).getNombre() == ing){
            linea = "\0";
            return true;
        }
        else{
          return false;
        }
      }
      else{
        if(ing == " "){
          ing = linea.substr(0,pos);
        }
        else{
          ing += linea.substr(0,pos);
        }
        if(is.get(ing).getNombre() == ing){
            linea = linea.substr(pos+1);
            return true;
        }
        else{
          ing += " ";
          linea = linea.substr(pos+1);
          obtenerIngrediente(linea,ing);
        }
      }
    }
}

//Operador >>
istream & operator >>(istream& is, instrucciones& i){

    stack<ArbolBinario<string>> pila;

    ArbolBinario<string> ab;
    string linea = " ";
    getline(is,linea);

    do{

        //accion
        string accion;
        int pos = linea.find(" ");
        if (pos == -1){
          pos = linea.find("\r");
        }
        accion = linea.substr(0,pos);
        linea = linea.substr(pos+1);
        ab = ArbolBinario<string>(accion);

        //Se comprueba la ariedad de la accion

        unsigned int ariedad = 0;
        ariedad = i.acc.getAriedad(accion);

        if(ariedad == 2){   //Si la ariedad es 2, se añaden las instrucciones

            string ing1=" ";

            if(i.obtenerIngrediente(linea, ing1)){

                //Añadimos la instruccion como hijo a la derecha
                ab.Insertar_Hd(ab.getRaiz(), ing1);

            }else{

                //Añadimos la instruccion como hijo a la derecha
                ab.Insertar_Hd(ab.getRaiz(), pila.top());
                pila.pop();
            }

            string ing2=" ";

            if(i.obtenerIngrediente(linea, ing2)){

                //Añadimos la instruccion como hijo a la izquierda
                ab.Insertar_Hi(ab.getRaiz(), ing2);

            }else{

                //Añadimos la instruccion como hijo a la izquierda
                ab.Insertar_Hi(ab.getRaiz(), pila.top());
                pila.pop();
            }
        }
        else{   //Si solo hay una instruccion, se pone como hijo a la izquierda

            string ing3=" ";

            if(i.obtenerIngrediente(linea, ing3)){

                //Añadimos la instruccion como hijo a la izquierda
                ab.Insertar_Hi(ab.getRaiz(), ing3);

            }else{

                //Añadimos la instruccion como hijo a la izquierda
                ab.Insertar_Hi(ab.getRaiz(), pila.top());
                pila.pop();
            }
        }

        //Se guarda y seguimos
        pila.push(ab);

        getline(is,linea);  //Obtenemos siguiente linea

    }while(linea!="\0");    //Final del fichero

    //Si hemos acabado, esas seran las instrucciones
    i.setInstrucciones(ab);

    return is;

}

//Operador <<
ostream & operator <<(ostream& os, instrucciones& i){

    string ing1, ing2, accion;
    ing1 = ing2 = accion = "";
    ArbolBinario<string>::postorden_iterador poit;

    //Recorremos el árbol de instrucciones en postorden
    for(poit = i.datos.beginpostorden(); poit != i.datos.endpostorden(); ++poit){

        //Si es una hoja, es un ingrediente
        if(poit.hi().nulo() && poit.hd().nulo()){

            if(ing1 == "")  //Si ya tiene un ingrediente
                ing1 = (*poit);
            else    //Añadimos el otro ingrediente
                ing2 = (*poit);

        }else{  //Si no es hoja, es una accion, asique mostramos

            accion = (*poit);

            os << "         " << accion << " " << ing1 << " " << ing2 << endl;

            ing1 = ing2 = accion = "";
        }
    }

    return os;
}

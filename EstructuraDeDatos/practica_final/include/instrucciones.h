/**
* @file instrucciones.h
* @brief Fichero cabecera del TDA instrucciones
*
*/

//Fichero instrucciones.h

#ifndef INSTRUCCIONES_H
#define INSTRUCCIONES_H

#include "acciones.h"
#include "arbolbinario.h"
#include "ingredientes.h"

using namespace std;

/**
*  @brief T.D.A. Instrucciones
*
* Una instancia @e c del tipo de datos abstractos @c Instrucciones es un objeto
* que contiene un árbol con los pasos a seguir para llevar a cabo una receta, incluyendo
* además las acciones disponibles
*
* @author Ramón Jesús Torres Madrid
* @author David López Maldonado
*/

class instrucciones{

private:

/**
* @page repColeccion Rep del TDA instrucciones
*
* @section invColeccion Invariante de la representación
*
* El invariante es que rep.datos != null && rep.acciones != null
* && rep.ingredientes != null
*
* @section faColeccion Función de abstracción
*
* Un objeto válido @e rep del TDA instrucciones representa
*
*                        rep.raiz->et
*                        /        \
*                       /          \
*   Arbol(rep.raiz->hizq)           Arbol(rep.raiz->hder)
*
* siendo cada nodo una instrucción de la receta
*
*/

  ArbolBinario<string> datos; /**< árbol de instrucciones a seguir */
  acciones acc; /**< acciones disponibles */
  ingredientes is; /**< ingredientes disponibles*/

public:

  /**
  * @brief Constructor por defecto de la clase
  * @return Crea las instrucciones por defecto
  */
  instrucciones();

  /**
  * @brief Modificador de las acciones
  * @param ac acciones disponibles que se añaden
  */
  void setAcciones(acciones ac);

  /**
  * @brief Modificador de las instrucciones
  * @param ab árbol de instrucciones de la receta que se añaden
  */
  void setInstrucciones(ArbolBinario<string> ab);

  /**
  * @brief Modificador de los ingredientes
  * @param is ingredientes disponibles que se añaden
  */
  void setIngredientes(ingredientes is);

  /**
  * @brief Consultor de las instrucciones de la receta
  * @return devuelve el árbol con las instrucciones de la receta
  */
  ArbolBinario<string> getArbolInstrucciones();

  /**
  * @brief Obtiene uno a uno los ingredientes de la linea
  * @param linea es un string con ingredientes de la instrucción leída
  * @param ing es el string donde se guardara el ingrediente de la línea
  * @return devuelve true si lo ha encontrado en la lista de ingredientes, si no, devuelve false
  */
  bool obtenerIngrediente(string & linea, string & ing);

  /**
  * @brief Entrada de unas instrucciones desde istream
  * @param is stream de entrada
  * @param i instrucciones que reciben los valores
  * @retval Las instrucciones leídas
  * @pre La entrada tiene el formato accion ingrediente1 ingrediente2
  * con \e accion, \e ingrediente1, \e ingrediente2, los valores
  * de su información respectiva que se añadirán a un árbol como raíz (accion) e hijos (ingredientes)
  */
  friend istream& operator>> (istream& is, instrucciones& i);
  
  /**
  * @brief Salida de unas instrucciones a ostream
  * @param os stream de salida
  * @param i instrucciones a escribir
  * @post Se obtiene en \a os la cadena de instrucciones con su información
  */
  friend ostream& operator<< (ostream& os, instrucciones& i);
};

//Fin de instrucciones.h

#endif

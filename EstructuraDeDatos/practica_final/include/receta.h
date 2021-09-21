/**
  * @file receta.h
  * @brief Fichero cabecera del TDA receta
  *
  */

#ifndef RECETA_H
#define RECETA_H

#include<string>
#include<list>
#include<iostream>
#include "ingredientes.h"
#include "instrucciones.h"


using namespace std;

/**
  *  @brief T.D.A. Receta
  *
  * Una instancia @e c del tipo de datos abstractos @c Receta es un objeto
  * que contiene la información de una receta, como puede ser su nombre, calorías,
  * Hidratos de carbono, proteínas, grasas, fibra, código, lista de ingredientes y plato.
  *
  * @author Ramón Jesús Torres Madrid
  * @author David López Maldonado
  */

class receta{

  private:

  /**
    * @page repColeccion Rep del TDA receta
    *
    * @section invColeccion Invariante de la representación
    *
    * El invariante es que rep.nombre != null && rep.code != null
    * && rep.plato != 0 && rep.calorias >= 0 && rep.Hc >= 0
    * && rep.proteinas >= 0 && rep.grasas >= 0 && rep.fibra >= 0
    * && rep.ings != null
    *
    * @section faColeccion Función de abstracción
    *
    * Un objeto válido @e rep del TDA receta representa
    *
    * (rep.code, rep.plato, rep.nombre, rep.ings, rep.calorias, rep.Hc, rep.proteinas, rep.grasas, rep.fibra)
    *
    */

    string code; /**< código de la receta */
    unsigned int plato; /**< número de plato de la receta */
    string nombre; /**< nombre de la receta */
    list<pair<string, unsigned int>> ings; /**< ingredientes de la receta */
    double calorias, hc, grasas, proteinas, fibra; /**< información de la receta */
    instrucciones inst;

  public:

    /** clase que nos servirá como ayuda para las recetas*/
    class iterator{

      private:

        list<pair<string, unsigned int>>::iterator it;

      public:

        iterator(){}

        iterator operator++(){
          ++it;
          return *this;
        }

        iterator operator--(){
          --it;
          return *this;
        }

        pair<string, unsigned int>& operator*(){
          return *it;
        }

        bool operator==(const iterator &otro)const{
          return it == otro.it;
        }

        bool operator!=(const iterator &otro)const{
          return it != otro.it;
        }

        friend class receta;
    };

    /** clase que nos servirá como ayuda para las recetas*/
    class const_iterator{
      private:

        list<pair<string, unsigned int>>::const_iterator it;

      public:

        const_iterator(){}

        const_iterator operator++(){
          ++it;
          return *this;
        }

        const_iterator operator--(){
          --it;
          return *this;
        }

        const pair<string, unsigned int>& operator*(){
          return *it;
        }

        bool operator==(const const_iterator &otro) const{
          return it == otro.it;
        }

        bool operator!=(const const_iterator &otro) const{
          return it != otro.it;
        }

        friend class receta;
    };


    /**
    * @brief Constructor por defecto de la clase
    * @return Crea la receta con todo a 0
    */
    receta();

    /**
    * @brief Modificador de código
    */
    void setCode(string cod);

    /**
    * @brief Modificador de plato
    */
    void setPlato(unsigned int num);

    /**
    * @brief Modificador de nombre
    */
    void setNombre(string nom);

    /**
    * @brief Modificador de instrucciones
    */
    void setInstrucciones(instrucciones i, acciones ac);

    /**
    * @brief Código
    * @return Devuelve el código de la receta
    */
    string getCode();

    /**
    * @brief Plato
    * @return Devuelve el número de plato de la receta
    */
    unsigned int getPlato();

    /**
    * @brief Nombre
    * @return Devuelve el nombre de la receta
    */
    string getNombre();

    /**
    * @brief Lista de ingredientes
    * @return Devuelve la lista de ingredientes de la receta
    */
    list<pair<string, unsigned int>> getIngredientes();

    /**
    * @brief Calorías
    * @return Devuelve la cantidad de calorías de la receta
    */
    double getCalorias();

    /**
    * @brief Hc
    * @return Devuelve la cantidad de hidratos de carbono de la receta
    */
    double getHc();

    /**
    * @brief Grasas
    * @return Devuelve la cantidad de grasas de la receta
    */
    double getGrasas();

    /**
    * @brief Proteinas
    * @return Devuelve la cantidad de proteínas de la receta
    */
    double getProteinas();

    /**
    * @brief Fibra
    * @return Devuelve la cantidad de fibra de la receta
    */
    double getFibra();

    /**
    * @brief Instrucciones
    * @return Devuelve las instrucciones de la receta
    */
    instrucciones getInstrucciones();

    /**
    * @brief Número de ingredientes
    * @return Devuelve el número de ingredientes de la receta
    */
    int ningredientes();

    /**
    * @brief Añade un ingrediente
    */
    void set_ingrediente(pair<string, unsigned int> &a);

    /**
    * @brief Revierte la lista
    */
    void revertir_lista();

    /**
    * @brief Limpia la lista
    */
    void clear();

    /**
    * @brief Añade los nutrientes a cada receta
    */
    void aniadirNutrientes(ingredientes &is);

    /**
    * @brief Salida de una receta a ostream
    * @param os stream de salida
    * @param r receta a escribir
    * @post Se obtiene en \a os la cadena de la receta con su información
    */
    friend ostream& operator<< (ostream& os, const receta& r);

    /**
    * @brief Entrada de una receta desde istream
    * @param is stream de entrada
    * @param r receta que recibe el valor
    * @retval La receta leída en r
    * @pre La entrada tiene el formato code;plato;nombre;ingrediente[0] gramos, ....,ingrediente[i] gramos
    * con \e code, \e plato, \e nombre, \e ingrediente, e/ gramos, los valores
      de su información respectiva
    */
    friend istream& operator>> (istream& is, receta& r);
    /**
    * @brief Operador de igualdad entre dos recetas
    * @param r receta a comparar
    * @retval devuelve true si son iguales y false si son diferentes
    */
    bool operator ==(receta& r);
		/**
    * @brief Operador menor entre dos recetas
    * @param r receta a comparar
    * @retval devuelve true si r es mayor que la receta actual, sino devuelve false
    */
    bool operator <(receta& r);

    /**
    * @brief Begin
    * @return Devuelve el indice del principio
    */
    iterator begin(){
      iterator i;
      i.it = ings.begin();
      return i;
    }

    /**
    * @brief End
    * @return Devuelve el indice del final
    */
    iterator end(){
      iterator i;
      i.it = ings.end();
      return i;
    }

    /**
    * @brief Begin constante
    * @return Devuelve el indice del principio
    */
    const_iterator begin()const{
      const_iterator i;
      i.it = ings.begin();
      return i;
    }

    /**
    * @brief End constante
    * @return Devuelve el indice del final
    */
    const_iterator end()const{
      const_iterator i;
      i.it = ings.end();
      return i;
    }
};

#endif

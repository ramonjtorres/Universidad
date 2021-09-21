/**
  * @file acciones.h
  * @brief Fichero cabecera del TDA acciones
  *
  */

//Fichero acciones.h

#ifndef ACCIONES_H
#define ACCIONES_H

#include<string>
#include<map>
#include<iostream>
#include<cstdlib>


using namespace std;

/**
  *  @brief T.D.A. Acciones
  *
  * Una instancia @e c del tipo de datos abstractos @c Acciones es un objeto
  * que contiene las acciones disponibles para una receta.
  *
  * @author Ramón Jesús Torres Madrid
  * @author David López Maldonado
  */

class acciones{

  private:
  
  /**
  * @page repColeccion Rep del TDA instrucciones
  *
  * @section invColeccion Invariante de la representación
  *
  * El invariante es que rep.datos != null
  *
  * @section faColeccion Función de abstracción
  *
  * Un objeto válido @e rep del TDA acciones representa
  * 
  * (rep.datos)
  * 
  */
  
    map<string, unsigned int> datos; /**< contenedor de acciones */

  public:

    /**
    * @brief Constructor por defecto de la clase
    * @return Crea las acciones por defecto
    */
    acciones();
  
    /**
    * @brief Insertar una acción en el contenedor de acciones
    * @param accion es la acción a realizar en la receta
    * @param ariedad es el número de ingredientes sobre los que se aplica la acción
    */
    void insertar_accion(string accion, unsigned int ariedad);
  
    /**
    * @brief Consultor de la ariedad de la acción
    * @param accion es la acción que se pide consultar
    * @return Devuelve si se aplica la acción a 1 o 2 ingredientes
    */
    unsigned int getAriedad(string accion);
  
    /**
    * @brief Salida de unas acciones a ostream
    * @param os stream de salida
    * @param a acciones a escribir
    * @post Se obtiene en \a os la cadena de acciones
    */
    friend ostream& operator<< (ostream& os, acciones& a);
  
    /**
    * @brief Entrada de unas acciones desde istream
    * @param is stream de entrada
    * @param a acciones que reciben los valores
    * @retval Las acciones leídas
    * @pre La entrada tiene el formato de una linea por acción
    */
    friend istream& operator>> (istream& is, acciones& a);

    /* clases iterator para ayudar a la clase acciones*/
    class iterator{

    private:

      map<string, unsigned int>::iterator it;

    public:

      iterator(){}
      bool operator==(const iterator &i) const{
        return it == i.it;
      }

      bool operator!=(const iterator &i) const{
        return it != i.it;
      }

      string operator*(){
        string s = it->first+" "+ to_string(it->second);
        return s;
      }

      iterator operator++(){
        ++it;
        return *this;
      }

      iterator operator--(){
        --it;
        return *this;
      }

      friend class acciones;
    };

    class const_iterator{

    private:

      map<string, unsigned int>::const_iterator it;

    public:
      const_iterator(){}
      bool operator ==(const const_iterator &i) const{
        return it == i.it;
      }

      bool operator !=(const const_iterator &i) const{
        return it != i.it;
      }

      const string operator*(){
        string s = it->first + " " + to_string(it->second);
        return s;
      }

      const_iterator operator++(){
        ++it;
        return *this;
      }

      const_iterator operator--(){
        --it;
        return *this;
      }

      friend class acciones;

    };


  iterator begin(){
    iterator i;
    i.it = datos.begin();
    return i;
  }
  iterator end(){
    iterator i;
    i.it = datos.end();
    return i;
  }
  const_iterator begin() const{
    const_iterator i;
    i.it = datos.begin();
    return i;
  }
  const_iterator end() const{
    const_iterator i;
    i.it = datos.end();
    return i;
  }
  const_iterator operator--(){
    const_iterator i;
    --i.it;
    return i;
  }
  bool operator!=(const_iterator ip){
    const_iterator i;
    bool resultado = false;
    if(i.it != ip.it)
      return resultado = true;
    return resultado;
  }
};

#endif

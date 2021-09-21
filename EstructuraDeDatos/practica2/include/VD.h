/**
  * @file VD.h
  * @brief Fichero cabecera del TDA Vector Dinámico
  *
  */

#ifndef _VD_H_
#define _VD_H_

using namespace std;

/**
  *  @brief T.D.A. Vector Dinámico
  *@brief T.D.A. Vector dinamico
  *
  * Una instancia @v del tipo de datos abstractos @c VD es un objeto del tipo vector
  * con elementos, y con métodos de inserción, borrado y consulta.
  *
  * @author Ramón Jesús Torres Madrid
  * @author David López Maldonado
  */

template <class T>
class VD{

    private:

    /**
    * @page repVector Rep del TDA VD
    *
    * @section invVector Invariante de la representaci�n
    *
    * El invariante es \e rep.n!=0 y \e rep.reservados < rep.n
    *
    * @section faVector Función de abstracción
    *
    * Un objeto válido @e rep del TDA VD representa
    *
    * (rep.datos[0], ..., rep.datos[i], rep.datos[i+1], rep.datos[n-1]) con i < rep.n
    *
    */

        T * datos; /**< elementos del vector */
        int n;  /**< tamaño en el vector */
        int reservados; /**< tamaño reservado del vector */

        /**
        * @brief Cambio de tamaño. Reajusta el tamaño del vector
        * @param nuevo_tam nuevo tamaño reservado del vector
        */
        void resize(int nuevo_tam); 

    public:


        /**
        * @brief Constructor de la clase
        * @param n tamaño del vector, por defecto 10
        * @return Crea el vector con tamaño reservado n
        */
        VD(int n = 10);
        
        /**
        * @brief Constructor de copias de la clase
        * @param original.datos elementos del vector a construir
        * @param original.n tamaño del vector a construir
        * @param original.reservados tamaño reservado del vector a construir
        */
        VD(const VD<T> & original);

        /**
        * @brief Destructor de la clase
        */
        ~VD();
        /**
        * @brief Tamaño del vector
        * @return devuelve el tamaño del vector dinámico
        */
        int size() const;

        /**
        * @brief Sobrecarga del operador []
        * @param i posición en la que está el elemento que se busca
        * @return devuelve el elemento en la posición i
        */
        T & operator[](int i);

        /**
        * @brief Sobrecarga del operador []
        * @param i posición en la que está el elemento que se busca
        * @return devuelve el elemento en la posición i
        */
        const T & operator[](int i) const;
        
        /**
        * @brief Sobrecarga del operador =
        * @param vd.datos elementos del vector a asignar
        * @param vd.n tamaño del vector a asignar
        * @param vd.reservados tamaño reservado del vector a asignar
        * @return devuelve una copia del vector vd 
        */
        VD<T> & operator=(const VD<T> & vd);

        /**
        * @brief Inserta un elemento en el vector dinámico
        * @param datos dato a insertar
        * @param pos posición donde se quiere inserter datos
        */
        void insertar(const T & dato, int pos);

        /**
        * @brief Borra un elemento del vector dinámico
        * @param pos posición del elemento que se quiere borrar
        */
        void borrar(int pos);

};

#include "VD.cpp"

#endif
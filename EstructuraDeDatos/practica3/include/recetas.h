/**
  * @file recetas.h
  * @brief Fichero cabecera del TDA recetas
  *
  */

#ifndef RECETAS_H
#define RECETAS_H

#include "receta.h"
#include<string>
#include<map>

using namespace std;

/**
  *  @brief T.D.A. Recetas
  *
  * Una instancia @e c del tipo de datos abstractos @c Recetas es un objeto
  * que contiene la clave de la receta y la receta con su información, como puede ser su nombre, calorías,
  * Hidratos de carbono, proteínas, grasas, fibra, código, lista de ingredientes y plato.
  *
  * @author Ramón Jesús Torres Madrid
  * @author David López Maldonado
  */

class recetas{

  private:

    /**
    * @page repColeccion Rep del TDA recetas
    *
    * @section invColeccion Invariante de la representación
    *
    * El invariante es que rep.datos != null
    *
    * @section faColeccion Función de abstracción
    *
    * Un objeto válido @e rep del TDA recetas representa
    *
    * (rep.datos)
    *
    */

    map<string, receta> datos; /**< contenedor de recetas */

  public:

    recetas(){};
    friend istream& operator>>(istream &is, recetas &recets);
    friend ostream& operator<<(ostream &os, recetas &recets);
    receta operator[](string c){
      return datos[c];
    }
    void insertar( receta &r);
    unsigned int size() const{
      return datos.size();
    }

    const receta getReceta(string code) const;
    void borrar(string code);

    /** clase que nos servirá como ayuda para las recetas*/
    class iterator{

    private:

      map<string, receta>::iterator it;


    public:

      iterator(){}
      bool operator==(const iterator &i) const{
        return it == i.it;
      }

      bool operator!=(const iterator &i) const{
        return it != i.it;
      }

      receta& operator*(){
        return (*it).second;
      }

      iterator operator++(){
        ++it;
        return *this;
      }

      iterator operator--(){
        --it;
        return *this;
      }

      friend class recetas;
    };

    /** clase que nos servirá como ayuda para las recetas*/
    class const_iterator{

    private:

      map<string, receta>::const_iterator it;

    public:
      const_iterator(){}
      bool operator ==(const const_iterator &i) const{
        return it == i.it;
      }

      bool operator !=(const const_iterator &i) const{
        return it != i.it;
      }

      const receta& operator*(){
        return (*it).second;
      }

      const_iterator operator++(){
        ++it;
        return *this;
      }

      const_iterator operator--(){
        --it;
        return *this;
      }

      friend class recetas;

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

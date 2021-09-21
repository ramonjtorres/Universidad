/**
  * @file ingrediente.h
  * @brief Fichero cabecera del TDA ingrediente
  *
  */

#ifndef _INGREDIENTE
#define _INGREDIENTE

#include<iostream>


using namespace std;

/**
  *  @brief T.D.A. Ingrediente
  *
  * Una instancia @e c del tipo de datos abstractos @c Ingrediente es un objeto
  * que contiene la información de un ingrediente, como puede ser su nombre, calorías,
  * Hidratos de carbono, proteínas, grasas, fibra y tipo.
  *
  * @author Ramón Jesús Torres Madrid
  * @author David López Maldonado
  */

class ingrediente{

    private:

    /**
    * @page repColeccion Rep del TDA ingrediente
    *
    * @section invColeccion Invariante de la representación
    *
    * El invariante es que rep.nombre != null && rep.tipo != null
		* && rep.calorias >= 0 && rep.Hc >= 0 && rep.proteinas >= 0
		* && rep.grasas >= 0 && rep.fibra >= 0
    *
    * @section faColeccion Función de abstracción
    *
    * Un objeto válido @e rep del TDA ingrediente representa
    *
    * (rep.nombre, rep.calorias, rep.Hc, rep.proteinas, rep.grasas, rep.fibra, rep.tipo)
    *
    */

        string nombre; /**< nombre del ingrediente */
        int calorias; /**< calorias (/100g) del ingrediente */
        float Hc; /**< % Hc del ingrediente */
        float proteinas; /**< % proteinas del ingrediente */
        float grasas; /**< % grasas del ingrediente */
        float fibra; /**< % fibra del ingrediente */
        string tipo; /**< tipo de alimento del ingrediente */

    public:

    /**
    * @brief Constructor por defecto de la clase
    * @return Crea el ingrediente con todo a 0
    */
    ingrediente();

    /**
    * @brief Constructor de la clase
    * @param original.nombre nombre del ingrediente a construir
    * @param original.calorias calorias (/100g) del ingrediente a construir
    * @param original.Hc % Hc del ingrediente a construir
    * @param original.proteinas % proteinas del ingrediente a construir
    * @param original.grasas % grasas del ingrediente a construir
    * @param original.fibra % fibra del ingrediente a construir
    * @param original.tipo tipo de alimento del ingrediente a construir
    * @return Crea el ingrediente con la información dada
    */
    ingrediente(string n, int c, float hc, float p, float g, float f, string t);

    /**
    * @brief Constructor de copias de la clase
    * @param original.nombre nombre del ingrediente a construir
    * @param original.calorias calorias (/100g) del ingrediente a construir
    * @param original.Hc % Hc del ingrediente a construir
    * @param original.proteinas % proteinas del ingrediente a construir
    * @param original.grasas % grasas del ingrediente a construir
    * @param original.fibra % fibra del ingrediente a construir
    * @param original.tipo tipo de alimento del ingrediente a construir
    */
    ingrediente(const ingrediente & original);


    /**
    * @brief Nombre
    * @return Devuelve el nombre del ingrediente
    */
    string getNombre();

    /**
    * @brief Calorías
    * @return Devuelve las calorías (/100g) del ingrediente
    */
    double getCalorias();

    /**
    * @brief Hc
    * @return Devuelve el % de hidratos de carbono del ingrediente
    */
    double getHc();

    /**
    * @brief Proteinas
    * @return Devuelve el % de proteínas del ingrediente
    */
    double getProteinas();

    /**
    * @brief Grasas
    * @return Devuelve el % de grasas del ingrediente
    */
    double getGrasas();

    /**
    * @brief Fibra
    * @return Devuelve el % de fibra del ingrediente
    */
    double getFibra();

    /**
    * @brief Tipo
    * @return Devuelve el tipo de alimento del ingrediente
    */
    string getTipo();

    /**
    * @brief Modificador de Nombre
    * @param n nombre del ingrediente a asignar
    */
    void setNombre(string n);

    /**
    * @brief Modificador de Calorías
    * @param c calorías (/100g) del ingrediente a asignar
    */
    void setCalorias(int c);

    /**
    * @brief Modificador de Hc
    * @param hc % de hidratos de carbono del ingrediente a asignar
    */
    void setHc(float hc);

    /**
    * @brief Modificador de Proteinas
    * @param p % de proteínas del ingrediente a asignar
    */
    void setProteinas(float p);

    /**
    * @brief Modificador de Grasas
    * @param g % de grasas del ingrediente a asignar
    */
    void setGrasas(float g);

    /**
    * @brief Modificador de Fibra
    * @param f % de fibra del ingrediente a asignar
    */
    void setFibra(float f);

    /**
    * @brief Modificador de Tipo
    * @param t tipo de alimento del ingrediente a asignar
    */
    void setTipo(string t);

    /**
    * @brief Salida de un ingrediente a ostream
    * @param os stream de salida
    * @param i ingrediente a escribir
    * @post Se obtiene en \a os la cadena del ingrediente con su información
    */
    friend ostream& operator<< (ostream& os, const ingrediente& i);

    /**
    * @brief Entrada de un ingrediente desde istream
    * @param is stream de entrada
    * @param r ingrediente que recibe el valor
    * @retval El ingrediente leído en i
    * @pre La entrada tiene el formato nombre;calorias;Hc;proteinas;grasas;fibra;tipo
    * con \e nombre,\e calorias, \e Hc, \e proteinas, \e grasas, \e fibra, \e tipo, los valores
      de su información respectiva
    */
    friend istream& operator>> (istream& is, ingrediente& i);
    /**
    * @brief Operador de igualdad entre dos ingredientes
    * @param i1 ingrediente a comparar
    * @param i2 otro ingrediente a comprar
    * @retval devuelve true si son iguales y false si son diferentes en tipo y nombre
    */
    bool operator ==(ingrediente& i);
		/**
    * @brief Operador menor entre dos ingredientes
    * @param i1 ingrediente a comparar
    * @param i2 otro ingrediente a comprar
    * @retval devuelve true si i1 es menor que i2 sino devuelve false
    */
    bool operator <(ingrediente& i);


};

#endif

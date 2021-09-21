/**
  * @file ingredientes.h
  * @brief Fichero cabecera del TDA ingredientes
  *
*/

#ifndef _INGREDIENTES
#define _INGREDIENTES

#include "ingrediente.h"
#include <vector>

using namespace std;

/**
  *  @brief T.D.A. ingredientes
  *
  * Una instancia @e c del tipo de datos abstractos @c Ingredientes es un objeto
  * de una colección ordenada de objetos de tipo Ingrediente, compuestos por los datos de los ingredientes y
  * de un vector de enteros ordenado que indican el indice del tipo de ingrediente.
  *
  * @author Ramón Jesús Torres Madrid
  * @author David López Maldonado
*/

struct mypair{/** struct que nos servirá para insertar nuevos ingredientes*/
	bool esta;
	int pos;
};

class ingredientes{

    private:
    	/**
    	* @page repColeccion Rep del TDA ingredientes
    	*
    	* @section invColeccion Invariante de la representación
    	*
    	* El invariante es rep.datos.size() > 0 && rep.indice.size() > 0
    	*                  && rep.datos.size() == rep.indice.size()
    	*
    	* @section faColeccion Función de abstracción
    	*
    	* Un objeto válido @e rep del TDA ingredientes representa
    	*
    	* (rep.datos[i].nombre, rep.datos[i].calorias, rep.datos[i].Hc, rep.datos[i].proteinas,
    	*  rep.datos[i].grasas, rep.datos[i].fibra, rep.datos[i].tipo) con i < rep.datos.size()
    	*
    	*/


			vector<ingrediente> datos; /**< elementos con datos de los ingredientes ordenados según nombre*/
			vector<int> indice; /**< indices de los elementos del vector ordenados según tipo */

		public:

			class iterator{
			private:
				vector<ingrediente>::iterator it;
			public:
				iterator(){}
				bool operator==(const iterator &i) const{
					return it == i.it;
				}
				bool operator!=(const iterator &i) const{
					return it != i.it;
				}
				ingrediente& operator*(){
					return *it;
				}
				iterator operator++(){
					++it;
					return *this;
				}
				iterator operator--(){
					--it;
					return *this;
				}
			friend class ingredientes;
			};

			class const_iterator{
			private:
				vector<ingrediente>::const_iterator it;
			public:
				const_iterator(){}
				bool operator==(const const_iterator &i) const{
					return it == i.it;
				}
				bool operator!=(const const_iterator &i) const{
					return it != i.it;
				}
				ingrediente& operator*(){
					return *it;
				}
				const_iterator operator++(){
					++it;
					return *this;
				}
				const_iterator operator--(){
					--it;
					return *this;
				}
			friend class ingredientes;
			};
			/**
    	* @brief Constructor por defecto de la clase
    	* @return Crea el ingredientes vacío
    	*/
    	ingredientes();
    	/**
    	* @brief Insertar un ingrediente en ingredientes
    	* @param i ingrediente a insertar
    	* @post se debe haber insertado el nuevo ingrediente
    	*/
		void Insertar(ingrediente &i);
		/**
    	* @brief Borra un ingrediente en ingredientes
    	* @param s nombre del ingrediente a borrar
    	* @post se debe haber borrado el ingrediente cuyo nombre fuera s
    	*/
		void borrar(string s);
		/**
    	* @brief Obtiene el ingrediente en la posición i según el orden del nombre
    	* @param i posicion del ingrediente que queremos
		* @return devuelve el ingrediente en la posición i
    	* @post debe darse una posicion correcta
    	*/
		ingrediente obtIngNom(int i);
		/**
    	* @brief Obtiene la información de un ingrediente dando su nombre
    	* @param n nombre del ingrediente del que se quiere obtener la información
		* @return devuelve el ingrediente con toda la información
    	* @post debe darse un nombre correcto
    	*/
		ingrediente get(string &n);
		/**
    	* @brief Obtiene en i todos los ingredientes ordenados por tipo
    	* @param i objeto ingredientes donde se almacenarán los ingredientes ordenados por tipo
		* @retval los ingredientes que va guardando en i
    	* @post debe darse un nombre correcto
    	*/
		void ImprimirPorTipo();
		/**
    	* @brief Obtiene todos los ingredientes de un tipo
    	* @param i Ingredientes en los que se va a almacenar los que sean del mismo tipo
		* @retval los ingredientes que va guardando
    	* @post debe darse un tipo correcto
    	*/
		ingredientes getIngredienteTipo(string tipo);
		/**
    	* @brief Obtiene un vector de string con todos los tipos distintos
    	* @retval los tipos de ingredientes
    	*/
		vector<string> getTipos();
		/**
    	* @brief Elimina el ingrediente en la posicion pos e inserta el nuevo ingrediente i
    	* @param pos posicion del ingrediente a eliminar
    	* @pre La posición dada en pos debe ser correcta
		*/
		void modIng(ingrediente &i, int pos);
		/**
    	* @brief Accede al elemento en la posicion i de datos y lo devuelve
    	* @param i posicion del elemento en datos a obtener
    	* @return devuelve el ingrediente en esa posición
    	* @pre La posición dada en i debe ser correcta
		*/
		const ingrediente& operator[] (int i) const;
		/**
    	* @brief Accede al elemento en la posicion i de datos y lo devuelve
    	* @param i posicion del elemento en datos a obtener
    	* @return devuelve el ingrediente en esa posición
    	* @pre La posición dada en i debe ser correcta
		*/
		ingrediente& operator[] (int i);
		/**
    	* @brief Entrada de ingredientes desde istream
    	* @param is stream de entrada
    	* @param i ingredientes que reciben el valor
    	* @retval Los ingredientes leidos en i
    	* @pre La entrada tiene un ingrediente en cada linea
		*/
		friend istream& operator>> (istream& is, ingredientes& i);
		/**
    	* @brief Salida de ingredientes desde istream
    	* @param os stream de salida
    	* @param i ingredientes que tienen el valor
		*/
		friend ostream& operator<< (ostream& os, ingredientes& i);
		/**
    	* @brief Delete a datos y indice
		*/
		void clear();
		/**
    	* @brief Devuelve el tamaño de datos
		*/
		int size();
		/**
    	* @brief Búsqueda binaria para ayudar a la función insertar ingrediente
    	* @param inicio posición de inicio
		* @param fin posición final
		* @param x ingrediente a insertar
		*/
		mypair BBinariaIngrediente(int inicio, int fin, ingrediente x);
		/**
    	* @brief Búsqueda binaria para ayudar a la función insertar indice
       	* @param inicio posición de inicio
		* @param fin posición final
		* @param x ingrediente a insertar
		*/
		mypair BBinariaIndice(int inicio, int fin, ingrediente x);

		iterator begin(){
			iterator i;
			i.it = datos.end();
			return i;
		}
		iterator end(){
			iterator i;
			i.it = datos.end();
			return i;
		}
		const_iterator begin()const{
			const_iterator i;
			i.it = datos.begin();
			return i;
		}
		const_iterator end()const{
			const_iterator i;
			i.it = datos.end();
			return i;
		}
};

#endif

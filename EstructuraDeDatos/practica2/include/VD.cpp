using namespace std;

// Resize
template <class T>
void VD<T>::resize(int nuevo_tam){

    T * aux = new T[nuevo_tam];
    int minimo = (n < nuevo_tam) ? n : nuevo_tam;

    for(int i = 0; i < minimo; i++){

        aux[i] = datos[i];
    }

    reservados = nuevo_tam;
    n = minimo;
    delete[] datos;
    datos = aux;
}

//Constructor
template <class T>
VD<T>::VD(int n){

    if(n == 0){

        reservados = this->n = 0;
        datos = 0;
    }
    else{

        reservados = n;
        this->n = 0;
        datos = new T[reservados];
    }
}

//Constructor de copia
template <class T>
VD<T>::VD(const VD<T> &original){

    reservados = original.reservados;
    n = original.n;

    if(reservados > 0){

        datos = new T[reservados];
    }
    else{

        datos = 0;
    }

    for(int i = 0; i < n; i++){

        datos[i] = original.datos[i];
    }
}

//Destructor
template <class T>
VD<T>::~VD(){

    if(datos != 0){

        delete[] datos;
    }
}

//Tamaño del vector dinámico
template <class T>
int VD<T>::size() const{

    return n;
}

//Operador []
template <class T>
T & VD<T>::operator[](int i){

    return datos[i];
}

//Operador []
template <class T>
const T & VD<T>::operator[](int i) const{

    return datos[i];
}

//Operador =
template <class T>
VD<T> & VD<T>::operator=(const VD<T> &vd){

    if(this != &vd){

        if(datos != 0){

            delete[] datos;
        }

        reservados = vd.reservados;
        n = vd.n;

        if(vd.datos != 0){

            datos = new T[reservados];
        }

        for(int i = 0; i < n; i++){

            datos[i] = vd.datos[i];
        }
    }

    return *this;
}

//Inserta elemento en el vector dinámico
template <class T>
void VD<T>::insertar(const T &dato, int pos){

    if(n >= reservados){

        resize(2*reservados);
    }

    for(int i = n; i > pos; i--){

        datos[i] = datos[i-1];
    }

    datos[pos] = dato;
    n++;
}

//Borra elemento del vector
template <class T>
void VD<T>::borrar(int pos){

    for(int i = pos; i < n-1; i++){

        datos[i] = datos[i+1];
    }

    n--;

    if(n < reservados/4){

        resize(reservados/2);
    }
}

#include <iostream>
#include "VD.h"

using namespace std;

int main() {

	VD <int> vector_dinamico = VD<int>(10);
    VD <int> vector_dinamico2 = VD<int>(15);

	for (int i=0; i<10; i++){
		
        vector_dinamico.insertar(i*2, i);
	}

    for (int i=0; i<15; i++){
		
        vector_dinamico2.insertar(i*3, i);
	}

    cout << "Tamaño v1: " << vector_dinamico.size() << endl;
    cout << "Tamaño v2: " << vector_dinamico2.size() << endl;

    VD <int> vector_dinamico3 = VD<int>(vector_dinamico);
    VD <int> vector_dinamico4;

    vector_dinamico4 = vector_dinamico2;
    
	cout << "Tamaño v3: " << vector_dinamico3.size() << endl;
    cout << "Tamaño v4: " << vector_dinamico4.size() << endl;

    vector_dinamico3.borrar(5);
    vector_dinamico4.borrar(7);

    cout << "Tamaño v3: " << vector_dinamico3.size() << endl;
    cout << "Tamaño v4: " << vector_dinamico4.size() << endl;

	for (int i=0; i<vector_dinamico3.size(); i++){
	
    	cout << vector_dinamico3[i] << " ";
    }

    cout << "\n";

    for (int i=0; i<vector_dinamico4.size(); i++){
	
    	cout << vector_dinamico4[i] << " ";
    }

	return(0);
}
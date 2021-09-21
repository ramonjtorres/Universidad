#include <iostream>
#include <ctime>    // Recursos para medir tiempos
#include <cstdlib>  // Para generación de números pseudoaleatorios

using namespace std;
 

void sintaxis()
{
  cerr << "Sintaxis:" << endl;
  cerr << "  TAM: Tamaño del vector (>0)" << endl;
  cerr << "  VMAX: Valor máximo (>0)" << endl;
  cerr << "Se genera un vector de tamaño TAM con elementos aleatorios en [0,VMAX[" << endl;
  exit(EXIT_FAILURE);
}

int main(int argc, char * argv[])
{
  // Lectura de parámetros
  if (argc!=3)
    sintaxis();
  int tam=atoi(argv[1]);     // Tamaño del vector
  int vmax=atoi(argv[2]);    // Valor máximo
  if (tam<=0 || vmax<=0)
    sintaxis();
  
  // Generación del matriz aleatoria
	int **A = new int*[tam];
	int **B = new int*[tam];
	int **C = new int*[tam];
	for (int i = 1; i <tam; i++) {
    A[i] = new int[tam];
		B[i] = new int[tam];
		C[i] = new int[tam];
	}       
  srand(time(0));            

  for (int i=1; i<tam; i++){
		for(int j=1; j<tam; j++){  
    	A[i][j] = rand() % vmax;
			B[i][j] = rand() % vmax;
			C[i][j] = 0;

  	}
	}
  clock_t tini;    // Anotamos el tiempo de inicio
  tini=clock();

	for(int i=1;i<tam;i++){
		for(int j=1;j<tam;j++){
			for(int k=1;k<tam;k++){
				C[i][j]=C[i][j]+A[i][k]*B[k][j];
			}
		}
	}
  
  clock_t tfin;    // Anotamos el tiempo de finalización
  tfin=clock();

  // Mostramos resultados
  cout << tam << "\t" << (tfin-tini)/(double)CLOCKS_PER_SEC << endl;
  
	for (int i = 1; i < tam; i++) {
  	delete [] A[i];
		delete [] B[i];
		delete [] C[i];
  }
    delete [] A;
		delete [] B;
		delete [] C;

}

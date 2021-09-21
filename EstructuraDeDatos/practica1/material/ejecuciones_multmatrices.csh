#!/bin/csh
@ inicio = 100
@ fin = 3000
@ incremento = 50
set ejecutable = multiplicacion_matrices
set salida = multiplicacion_matri_resu.dat

@ i = $inicio
echo > $salida
while ( $i <= $fin )
  echo Ejecución tam = $i
  echo `./{$ejecutable} $i 10000` >> $salida
  @ i += $incremento
end

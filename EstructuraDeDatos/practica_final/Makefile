SRC = src
INC = include
OBJ = obj
BIN = bin
CXX = g++
CPPFLAGS = -Wall -g  -I$(INC) -c --std=c++11

all:$(BIN)/test_acciones $(BIN)/test_instrucciones $(BIN)/cocinero_integral

# ************ Generación de documentación ******************
documentacion:
	doxygen doc/doxys/Doxyfile


# ************ Compilación de módulos ************

$(OBJ)/ingredientes.o: $(SRC)/ingredientes.cpp $(INC)/ingredientes.h $(INC)/ingrediente.h
	$(CXX) $(CPPFLAGS)  $(SRC)/ingredientes.cpp -o  $(OBJ)/ingredientes.o

$(OBJ)/ingrediente.o: $(SRC)/ingrediente.cpp $(INC)/ingrediente.h
	$(CXX) $(CPPFLAGS)  $(SRC)/ingrediente.cpp -o  $(OBJ)/ingrediente.o

$(OBJ)/receta.o: $(SRC)/receta.cpp $(INC)/receta.h $(INC)/ingrediente.h $(INC)/instrucciones.h
	$(CXX) $(CPPFLAGS)  $(SRC)/receta.cpp -o  $(OBJ)/receta.o

$(OBJ)/recetas.o: $(SRC)/recetas.cpp $(INC)/recetas.h $(INC)/receta.h
	$(CXX) $(CPPFLAGS)  $(SRC)/recetas.cpp -o  $(OBJ)/recetas.o

$(OBJ)/instrucciones.o: $(SRC)/instrucciones.cpp $(INC)/acciones.h $(INC)/instrucciones.h $(INC)/arbolbinario.h $(INC)/arbolbinario.tpp
	$(CXX) $(CPPFLAGS)  $(SRC)/instrucciones.cpp -o  $(OBJ)/instrucciones.o

$(OBJ)/acciones.o: $(SRC)/acciones.cpp $(INC)/acciones.h
	$(CXX) $(CPPFLAGS)  $(SRC)/acciones.cpp -o  $(OBJ)/acciones.o

$(BIN)/test_acciones: $(OBJ)/test_acciones.o $(OBJ)/acciones.o
	$(CXX) -o $(BIN)/test_acciones $(OBJ)/test_acciones.o $(OBJ)/acciones.o

$(OBJ)/test_acciones.o: $(SRC)/test_acciones.cpp $(INC)/acciones.h
	$(CXX) $(CPPFLAGS)  $(SRC)/test_acciones.cpp -o  $(OBJ)/test_acciones.o

$(BIN)/test_instrucciones: $(OBJ)/test_instrucciones.o $(OBJ)/ingrediente.o $(OBJ)/ingredientes.o $(OBJ)/acciones.o $(OBJ)/instrucciones.o
	$(CXX) -o $(BIN)/test_instrucciones $(OBJ)/test_instrucciones.o $(OBJ)/ingrediente.o $(OBJ)/instrucciones.o $(OBJ)/acciones.o $(OBJ)/ingredientes.o

$(OBJ)/test_instrucciones.o: $(SRC)/test_instrucciones.cpp $(INC)/ingrediente.h $(INC)/ingredientes.h $(INC)/acciones.h $(INC)/instrucciones.h
	$(CXX) $(CPPFLAGS)  $(SRC)/test_instrucciones.cpp -o  $(OBJ)/test_instrucciones.o

$(OBJ)/cocinero_integral.o: $(SRC)/cocinero_integral.cpp $(INC)/acciones.h $(INC)/receta.h $(INC)/recetas.h $(INC)/ingrediente.h $(INC)/ingredientes.h
	$(CXX) $(CPPFLAGS)  $(SRC)/cocinero_integral.cpp -o  $(OBJ)/cocinero_integral.o 

$(BIN)/cocinero_integral: $(OBJ)/cocinero_integral.o $(OBJ)/receta.o $(OBJ)/recetas.o $(OBJ)/ingrediente.o $(OBJ)/ingredientes.o $(OBJ)/instrucciones.o $(OBJ)/acciones.o
	$(CXX) -o $(BIN)/cocinero_integral $(OBJ)/cocinero_integral.o  $(OBJ)/receta.o $(OBJ)/recetas.o $(OBJ)/ingrediente.o $(OBJ)/ingredientes.o $(OBJ)/instrucciones.o $(OBJ)/acciones.o

# ************ Limpieza ************
clean :
	-rm $(OBJ)/* $(SRC)/*~ $(INC)/*~ ./*~

mrproper : clean
	-rm $(BIN)/* doc/html/*

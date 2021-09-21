SRC = src
INC = include
OBJ = obj
BIN = bin
CXX = g++
CPPFLAGS = -Wall -g  -I$(INC) -c --std=c++11
all:$(BIN)/test_ingredientes $(BIN)/test_receta $(BIN)/nutricion_receta

# ************ Generación de documentación ******************
documentacion:
	doxygen doc/doxys/Doxyfile


# ************ Compilación de módulos ************


$(BIN)/test_ingredientes: $(OBJ)/test_ingredientes.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o
	$(CXX) -o $(BIN)/test_ingredientes $(OBJ)/test_ingredientes.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o


$(OBJ)/test_ingredientes.o: $(SRC)/test_ingredientes.cpp $(INC)/ingrediente.h $(INC)/ingredientes.h
	$(CXX) $(CPPFLAGS)  $(SRC)/test_ingredientes.cpp -o  $(OBJ)/test_ingredientes.o


$(OBJ)/ingredientes.o: $(SRC)/ingredientes.cpp $(INC)/ingredientes.h $(INC)/ingrediente.h
	$(CXX) $(CPPFLAGS)  $(SRC)/ingredientes.cpp -o  $(OBJ)/ingredientes.o

$(OBJ)/ingrediente.o: $(SRC)/ingrediente.cpp $(INC)/ingrediente.h
	$(CXX) $(CPPFLAGS)  $(SRC)/ingrediente.cpp -o  $(OBJ)/ingrediente.o

$(OBJ)/receta.o: $(SRC)/receta.cpp $(INC)/receta.h $(INC)/ingrediente.h $(INC)/ingredientes.h
	$(CXX) $(CPPFLAGS)  $(SRC)/receta.cpp -o  $(OBJ)/receta.o

$(OBJ)/recetas.o: $(SRC)/recetas.cpp $(INC)/recetas.h $(INC)/receta.h
	$(CXX) $(CPPFLAGS)  $(SRC)/recetas.cpp -o  $(OBJ)/recetas.o

$(OBJ)/test_receta.o: $(SRC)/test_receta.cpp $(INC)/receta.h $(INC)/recetas.h
	$(CXX) $(CPPFLAGS)  $(SRC)/test_receta.cpp -o  $(OBJ)/test_receta.o

$(OBJ)/nutricion_receta.o: $(SRC)/nutricion_receta.cpp $(INC)/recetas.h $(INC)/receta.h $(INC)/ingredientes.h $(INC)/ingrediente.h
	$(CXX) $(CPPFLAGS)  $(SRC)/nutricion_receta.cpp -o  $(OBJ)/nutricion_receta.o

$(BIN)/test_receta: $(OBJ)/test_receta.o $(OBJ)/receta.o $(OBJ)/recetas.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o
	$(CXX) -o $(BIN)/test_receta $(OBJ)/test_receta.o $(OBJ)/receta.o $(OBJ)/recetas.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o

$(BIN)/nutricion_receta: $(OBJ)/nutricion_receta.o $(OBJ)/recetas.o $(OBJ)/receta.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o
	$(CXX) -o $(BIN)/nutricion_receta $(OBJ)/nutricion_receta.o $(OBJ)/recetas.o $(OBJ)/receta.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o

# ************ Limpieza ************
clean :
	-rm $(OBJ)/* $(SRC)/*~ $(INC)/*~ ./*~

mrproper : clean
	-rm $(BIN)/* doc/html/*

SRC = src
INC = include
OBJ = obj
BIN = bin
DOC = doc
CXX = g++
CPPFLAGS = -Wall -g  -I$(INC) -c --std=c++11
all:$(BIN)/test_ingredientes $(BIN)/tipos_ingredientes

# ************ Generación de documentación ******************
documentacion :
	-doxygen $(DOC)/doxys/Doxyfile


# ************ Compilación de módulos ************


$(BIN)/test_ingredientes: $(OBJ)/test_ingredientes.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o
	$(CXX) -o $(BIN)/test_ingredientes $(OBJ)/test_ingredientes.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o

$(OBJ)/test_ingredientes.o: $(SRC)/test_ingredientes.cpp $(INC)/ingrediente.h $(INC)/ingredientes.h
	$(CXX) $(CPPFLAGS)  $(SRC)/test_ingredientes.cpp -o  $(OBJ)/test_ingredientes.o

$(OBJ)/ingredientes.o: $(SRC)/ingredientes.cpp $(INC)/ingredientes.h $(INC)/VD.h $(INC)/VD.cpp $(INC)/ingrediente.h
	$(CXX) $(CPPFLAGS)  $(SRC)/ingredientes.cpp -o  $(OBJ)/ingredientes.o

$(OBJ)/ingrediente.o: $(SRC)/ingrediente.cpp $(INC)/ingrediente.h
	$(CXX) $(CPPFLAGS)  $(SRC)/ingrediente.cpp -o  $(OBJ)/ingrediente.o

$(BIN)/tipos_ingredientes: $(OBJ)/tipos_ingredientes.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o
	$(CXX) -o $(BIN)/tipos_ingredientes $(OBJ)/tipos_ingredientes.o $(OBJ)/ingredientes.o $(OBJ)/ingrediente.o

$(OBJ)/tipos_ingredientes.o: $(SRC)/tipos_ingredientes.cpp $(INC)/ingrediente.h $(INC)/ingredientes.h
	$(CXX) $(CPPFLAGS)  $(SRC)/tipos_ingredientes.cpp -o  $(OBJ)/tipos_ingredientes.o

# ************ Limpieza ************
clean :
	-rm $(OBJ)/* $(SRC)/*~ $(INC)/*~ ./*~

mrproper : clean
	-rm $(BIN)/* doc/html/*

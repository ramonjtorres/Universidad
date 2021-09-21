#encoding: utf-8

# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "jugador"
require_relative "mazo_sorpresas"
require_relative "tablero"
require_relative "dado"
require_relative "gestor_estados"
require_relative "sorpresa"
require_relative "sorpresa_jugador"
require_relative "sorpresa_especulador"
require_relative "sorpresa_casilla"
require_relative "sorpresa_carcel"
require_relative "sorpresa_edificacion"
require_relative "sorpresa_pagarcobrar"
require_relative "sorpresa_salvoconducto"
require_relative "titulo_propiedad"
require_relative "casilla"
require_relative "casilla_juez"
require_relative "casilla_sorpresa"
require_relative "casilla_impuesto"
require_relative "casilla_calle"
require_relative "diario"

module Civitas
  class Civitas_Juego
    
    attr_reader :mazo
    
    public
    def initialize(nombres)
 
      @jugadores = Array.new
      var = 0
      while (var < nombres.length())
        j = Jugador.new(nombres.at(var), nil)
        @jugadores.push(j)
        var = var + 1
      end
      
      @gestor_estados = Gestor_estados.new
      @estado = @gestor_estados.estado_inicial
      @indice_jugador_actual = Dado.instance.quien_empieza(@jugadores.length())
      @mazo = Mazo_Sorpresas.new()
      inicializar_tablero(@mazo)
      inicializar_mazo_sorpresas(@tablero)
    end
    
    private
    def avanza_jugador()
      
      jugador_actual = @jugadores.at(@indice_jugador_actual)
      posicion_actual = jugador_actual.num_casilla_actual
      tirada = Dado.instance.tirar
      posicion_nueva = @tablero.nueva_posicion(posicion_actual, tirada)
      casilla = @tablero.get_casilla(posicion_nueva)
      
      contabilizar_pasos_por_salida(jugador_actual)
      jugador_actual.mover_a_casilla(posicion_nueva)
      casilla.recibe_jugador(@indice_jugador_actual, @jugadores)
      contabilizar_pasos_por_salida(jugador_actual)
    end
    
    private
    def actualizar_info()
      puts "Estado: " + @estado.to_s + "\nInformación Jugador: " + @jugadores.at(@indice_jugador_actual).to_s
    end
    
    public
    def cancelar_hipoteca(ip)
      @jugadores.at(@indice_jugador_actual).cancelar_hipoteca(ip)
    end
    
    public
    def comprar()
      jugadorActual = @jugadores.at(@indice_jugador_actual)
      num_casilla_actual = jugadorActual.num_casilla_actual
      casilla = @tablero.get_casilla(num_casilla_actual)
      titulo = casilla.tituloPropiedad
      
      return jugadorActual.comprar(titulo)
      
      
    end
  
    public
    def construir_casa(ip)
      @jugadores.at(@indice_jugador_actual).construir_casa(ip)
    end
    
    public
    def construir_hotel(ip)
      @jugadores.at(@indice_jugador_actual).construir_hotel(ip)
    end
    
    private
    def contabilizar_pasos_por_salida(jugador_actual)
      while(@tablero.get_por_salida > 0)
        jugador_actual.pasa_por_salida
      end
    end
    
    public
    def final_del_juego()
      var = 0
      while(var<@jugadores.length)
        if(@jugadores.at(var).en_bancarrota)
          return true
        end
        var = var + 1
      end
      return false
    end
    
    public
    def get_casilla_actual()
      i = @jugadores.at(@indice_jugador_actual).num_casilla_actual
      return @tablero.get_casilla(i)
    end
    
    public
    def get_jugador_actual()
      return @jugadores.at(@indice_jugador_actual)
    end
    
    public
    def hipotecar(ip)
      return @jugadores.at(@indice_jugador_actual).hipotecar(ip)
      
    end
    
    private
    def inicializar_mazo_sorpresas(tablero)
      
      @mazo.al_mazo(Sorpresa_carcel.new(tablero))
      @mazo.al_mazo(Sorpresa_casilla.new(4,tablero))
      @mazo.al_mazo(Sorpresa_casilla.new(5,tablero))
      @mazo.al_mazo(Sorpresa_casilla.new(10,tablero))
      @mazo.al_mazo(Sorpresa_salvoconducto.new(@mazo))
      @mazo.al_mazo(Sorpresa_jugador.new(tablero,-50,"El jugador debe pagar a cada uno de los demas jugadores 50€"))
      @mazo.al_mazo(Sorpresa_jugador.new(tablero,50,"Cada jugador te debe pagar 50€"))
      @mazo.al_mazo(Sorpresa_edificacion.new(tablero,30,"Recibes 30€ por cada casa y hotel en propiedad"))
      @mazo.al_mazo(Sorpresa_edificacion.new(tablero,-30,"Cobras 30€ por cada casa y hotel en propiedad"))
      @mazo.al_mazo(Sorpresa_pagarcobrar.new(tablero,-100,"Pagas 100€ por gastos de limpieza"))
      @mazo.al_mazo(Sorpresa_pagarcobrar.new(tablero,100,"Has ganado un premio al hotel más limpio recibe 100€"))

      @mazo.al_mazo(Sorpresa_especulador.new(100, "Te conviertes en un especulador con 100€ de fianza"))
      @mazo.al_mazo(Sorpresa_especulador.new(200, "Te conviertes en un especulador con 200€ de fianza"))
      @mazo.al_mazo(Sorpresa_especulador.new(300, "Te conviertes en un especulador con 300€ de fianza"))
      
    end
    
    private
    def inicializar_tablero(mazo)
        
        @tablero = Tablero.new(4);#la carcel

        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Ronda de Valencia",10, 0.5,25,50,20)))
 
        @tablero.añade_casilla(Casilla_impuesto.new("Impuesto", 100));
        
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Lavapies",10,0.5,25,50,20)));
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Cuatro Caminos",20,0.6,30,70,40)));
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Reina Victoria",20,0.6,30,70,40)));
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Bravo Murillo",30,0.7,35,90,60)));
        
        @tablero.añade_casilla(Casilla_sorpresa.new("Sorpresa", mazo));
        
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Alberto Aguilera",40,0.7,35,90,80)));
        
        @tablero.añade_casilla(Casilla.new("Parking"));
        
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Fuencarral",40,0.8,40,110,80)));
        
        @tablero.añade_casilla(Casilla_sorpresa.new("Sorpresa", mazo));
        
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Felipe II",50,0.8,40,110,100)));
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Velázquez",50,0.8,45,130,100)));
        
        @tablero.añade_juez;
        
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Puerta del Sol",70,0.8,45,160,100)));
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Alcalá",70,0.8,50,160,100)));
        
        @tablero.añade_casilla(Casilla_sorpresa.new("Sorpresa", mazo));
        
        @tablero.añade_casilla(Casilla_calle.new(Titulo_Propiedad.new("Paseo del Prado",100,0.8,60,250,120)));
        
    end
    
    private
    def pasar_turno()
      @indice_jugador_actual = (@indice_jugador_actual + 1) % @jugadores.length
    end
    
    public
    def ranking()
      ranking = Array.new
      ranking = @jugadores
      
      ranking.sort!
      
      return ranking
    end
    
    public
    def salir_carcel_pagando()
      return @jugadores.at(@indice_jugador_actual).salir_carcel_pagando
    end
    
    public
    def salir_carcel_tirando()
      return @jugadores.at(@indice_jugador_actual).salir_carcel_tirando
    end
    
    public
    def siguiente_paso()
      
      jugadorActual = @jugadores.at(@indice_jugador_actual)
      
      operacion = @gestor_estados.operaciones_permitidas(jugadorActual, @estado)
      
      if(operacion == Operaciones_juego::PASAR_TURNO)
      
        pasar_turno()
        siguiente_paso_completado(operacion)
 
      elsif(operacion == Operaciones_juego::AVANZAR)
          avanza_jugador()
          siguiente_paso_completado(operacion)
      end
      
      return operacion   
    end
    
    public
    def siguiente_paso_completado(operacion)
      @estado = @gestor_estados.siguiente_estado(@jugadores.at(@indice_jugador_actual), @estado, operacion)
    end
    
    public
    def vender(ip)
      return @jugadores.at(@indice_jugador_actual).vender(ip)
    end
 
  end
  
end

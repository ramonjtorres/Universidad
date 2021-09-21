#encoding:utf-8
# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "civitas_juego"
require_relative "gestiones_inmobiliarias"
require_relative "operacion_inmobiliaria"
require_relative "operaciones_juego"
require_relative "respuestas"
require_relative "salidas_carcel"

module Civitas
  class Controlador
    
    def initialize(j, v)
      
      @juego = j
      @vista = v
      
    end
    
    def juega()
      
      @vista.setCivitasJuego(@juego)
      
      while(!@juego.final_del_juego())
        
        @vista.actualizarVista()
        
        @vista.pausa()
        
        operacion = @juego.siguiente_paso()
        
        @vista.mostrarSiguienteOperacion(operacion)
        
        if(operacion != Operaciones_juego::PASAR_TURNO)
          
          @vista.mostrarEventos()
        end
        
        if(!@juego.final_del_juego())
          
          if(operacion == Operaciones_juego::COMPRAR)
          
            #respuesta = @vista.comprar()
            respuesta = Respuestas::NO
            if(respuesta == Respuestas::SI)
              
              @juego.comprar()
              
            end
            
            @juego.siguiente_paso_completado(operacion)
          end
          
          if(operacion == Operaciones_juego::GESTIONAR)
          
            @vista.gestionar()
            
            ig = @vista.getGestion
            ip = @vista.getPropiedad

            lista_gestiones_inmobiliarias = [Gestiones_inmobiliarias::VENDER,
              Gestiones_inmobiliarias::HIPOTECAR, Gestiones_inmobiliarias::CANCELAR_HIPOTECA,
              Gestiones_inmobiliarias::CONSTRUIR_CASA, Gestiones_inmobiliarias::CONSTRUIR_HOTEL, Gestiones_inmobiliarias::TERMINAR]
            
            oi = Operacion_inmobiliaria.new(lista_gestiones_inmobiliarias[ig], ip)
                    
            if(oi.gestion == Gestiones_inmobiliarias::CANCELAR_HIPOTECA)
              
              @juego.cancelar_hipoteca(ip)
            
            elsif(oi.gestion == Gestiones_inmobiliarias::CONSTRUIR_CASA)
              
              @juego.construir_casa(ip)
            
            elsif(oi.gestion == Gestiones_inmobiliarias::CONSTRUIR_HOTEL)
              
              @juego.construir_hotel(ip)
              
            elsif(oi.gestion == Gestiones_inmobiliarias::HIPOTECAR)
              
              @juego.hipotecar(ip)
              
            elsif(oi.gestion == Gestiones_inmobiliarias::VENDER)
              
              @juego.vender(ip)
             
            else
              
              @juego.siguiente_paso_completado(operacion)
              
            end
          end
                
          if(operacion == Operaciones_juego::SALIR_CARCEL)
                
            #salida = @vista.salirCarcel()
              salida = Salidas_carcel::PAGANDO      
            if(salida == Salidas_carcel::PAGANDO)
                    
              @juego.salir_carcel_pagando()
                    
            else
                    
              @juego.salir_carcel_tirando()
            end
                   
            @juego.siguiente_paso_completado(operacion)           
          end
        end
      end
        
      ranking = @juego.ranking()
      
      puts("===================================================================")
      puts("Ranking:\n\n")
      
      for i in 0..ranking.length() do
        
        puts(ranking.at(i).to_s + "\n")
        
      end
      
    end
  end
end
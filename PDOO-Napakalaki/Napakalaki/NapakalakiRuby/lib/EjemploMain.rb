# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "napakalaki.rb"
require_relative "GameTester"
require_relative "player.rb"
require_relative "combat_result.rb"

module NapakalakiGame

  class EjemploMain
   
      def prueba
        
       test = Test::GameTester.instance
     
       game = Napakalaki.getInstance
   
       #Se prueba el juego con 2 jugadores
   
       test.play(game, 2);
       
      end
      
  end
  
    e = EjemploMain.new
    e.prueba()

end

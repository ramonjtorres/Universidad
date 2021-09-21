# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require "singleton"
require_relative "prize.rb"
require_relative "monster.rb"
require_relative "bad_consequence.rb"
require_relative "treasure.rb"
require_relative "treasure_kind.rb"
require_relative "card_dealer.rb"
require_relative "player.rb"
require_relative "combat_result.rb"
require_relative "cultist.rb"
require_relative "cultist_player.rb"

class Napakalaki
    include Singleton
    
    attr_accessor :currentPlayer, :players, :dealer, :currentMonster
  
   
    
    def initialize
      @currentPlayer = nil
      @players = Array.new
      @dealer = CardDealer.getInstance
      @currentMonster = nil
    end
    
    def getCurrentPlayer 
      return @currentPlayer
    end
    
    def getCurrentMonster
      return @currentMonster
    end
    
    def initPlayers(names) 
        names.each { |s|        
          @players << Player.new(s)
        }
    end
    
    def nextPlayer
      
       if (@currentPlayer == nil) 
                  
            sig = rand(@players.length)
            @currentPlayer = @players.at(sig)
      
      else
            sig = 0
            for i in (0..(@players.length-1))
            
                if(@players.at(i).name == @currentPlayer.name) 
                    sig = i                  
                end
            end
            sig = (sig + 1) % @players.length
            @currentPlayer = @players.at(sig)
       end  
                          
        return @currentPlayer
    end
    
    def nextTurnAllowed
        
       if(@currentPlayer == nil) 
            return true
              
        else 
            return @currentPlayer.validState
       end
        
    end
    
    def setEnemies        
      
        for i in (0..(@players.length-1)) 
            
            newEnemy = rand(@players.length)
            while(@players.at(i).enemy == nil) do
                newEnemy = rand(@players.length)
                if((newEnemy != i) && (@players.at(i).enemy == nil)) 
                    @players.at(i).enemy = @players.at(newEnemy)
                end
            end
        end
        
    end
    
    def self.getInstance
      return Napakalaki.instance
    end  
    
    def developCombat
      
       combatResult = @currentPlayer.combat(@currentMonster)
       @dealer.giveMonsterBack(@currentMonster)
       
      if(combatResult == CombatResult::LOSEANDCONVERT)
        c = @dealer.nextCultist
        p = CultistPlayer.new(@currentPlayer, c)
        @currentPlayer = p        
        for i in (0..(@players.length-1))
            
                if(@players.at(i).name == @currentPlayer.name) 
                    @players[i] = p              
                end
        end        
      end
      
       return combatResult
    end
    
    def discardVisibleTreasures(treasures)
        
      treasures.each { |t|
        
        @currentPlayer.discardVisibleTreasure(t)
        @dealer.giveTreasureBack(t)
      }     
        
    end
    
    def discardHiddenTreasures(treasures) 
        
      treasures.each { |t|
        
        @currentPlayer.discardHiddenTreasure(t)
        @dealer.giveTreasureBack(t)
      } 
      
    end
    
    def makeTreasuresVisible(treasures) 
        
      treasures.each { |t|
        
        @currentPlayer.makeTreasureVisible(t)
      }
            
    end
            
    def initGame(players)
        
        initPlayers(players)
        setEnemies
        @dealer.initCards
        nextTurn
    end
                       
    def nextTurn
     
        stateOk = nextTurnAllowed       
        if(stateOk) 
            @currentMonster = @dealer.nextMonster
            @currentPlayer = nextPlayer
            dead = @currentPlayer.isDead
            if(dead)
                @currentPlayer.initTreasures
            end
        end
        
        return stateOk
        
    end
            
    def endOfGame(result) 
    
      if(result == CombatResult::WINGAME) 
            return true
              
        else 
            return false
       end
    
    end
    private :initPlayers, :nextPlayer, :nextTurnAllowed, :setEnemies
end

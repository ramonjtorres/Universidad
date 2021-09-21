# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "prize.rb"

class Monster
  
  attr_accessor :name, :combatLevel, :bc, :prize, :levelChangeAgainstCultistPlayer
  
  def initialize(name, level, bc, prize, ic = 0)    
    @name = name
    @combatLevel = level
    @bc = bc
    @prize = prize
    @levelChangeAgainstCultistPlayer = ic
  end  
  
  def getLevelsGained
        return @prize.level
  end
    
  def getTreasuresGained
        return @prize.treasures
  end
  
  def getCombatLevelAgainstCultistPlayer
    return @levelChangeAgainstCultistPlayer + @combatLevel
  end
  
  def to_s
    "\nNombre del Monstruo: #{@name} \n Nivel de Combate: #{@combatLevel} \n #{bc.to_s} \n #{prize.to_s}"
  end
end

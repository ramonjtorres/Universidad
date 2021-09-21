# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "player.rb"

class CultistPlayer < Player
  
  @@totalCultistPlayers = 0
  
  attr_accessor :myCultistCard, :totalCultistPlayers
  
  def initialize(p, c)
    super(nil, p)    
    @myCultistCard = c
    @@totalCultistPlayers = @@totalCultistPlayers + 1
  end
  
  def getCombatLevel
    combatLevel = super.getCombatLevel * 1.7
    combatLevel = combatLevel + @myCultistCard.gainedLevels * @@totalCultistPlayers  
    
    return combatLevel.to_i
  end
  
  def getOponentLevel(m)
    return m.getCombatLevelAgainstCultistPlayer
  end
  
  def shouldConvert
    return false
  end
  
  def giveMeATreasure
    pos = rand(@visibleTreasures.length)
         
    return @visibleTreasures.at(pos)
  end
  
  def canYouGiveMeATreasure
    return !(@visibleTreasures.empty?)
  end
  
  def getTotalCultisPlayers
    return @@totalCultistPlayers
  end
  
end

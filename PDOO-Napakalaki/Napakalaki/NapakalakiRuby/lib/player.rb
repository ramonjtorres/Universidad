# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "treasure.rb"
require_relative "treasure_kind.rb"
require_relative "bad_consequence.rb"
require_relative "dice.rb"
require_relative "combat_result.rb"

class Player
  
  @@MAXLEVEL = 10
  
  attr_accessor :name, :level, :death, :canISteal, :visibleTreasures, :hiddenTreasures, :enemy, :pendingBadConsequence, :MAXLEVEL
  
  def initialize(name, p = nil)
        if(p.nil?)
          @name = name
          @death = true
          @canISteal = true
          @visibleTreasures = Array.new
          @hiddenTreasures = Array.new
          @enemy = nil
          @pendingBadConsequence = nil 
          @level = 1
        else
          @name = p.name
          @death = p.death
          @canISteal = p.canISteal
          @visibleTreasures = p.visibleTreasures
          @hiddenTreasures = p.hiddenTreasures
          @enemy = p.enemy
          @pendingBadConsequence = p.pendingBadConsequence
          @level = p.level
        end
  end
  
  def getVisibleTreasures
    return @visibleTreasures
  end
  
  def getHiddenTreasures
    return @hiddenTreasures
  end
  
  def getOponentLevel(m)
    return m.combatLevel
  end
  
  def bringToLife
    @death = false
  end

  def getCombatLevel
    bonus = 0
    @visibleTreasures.each { |v|
      bonus = bonus + v.bonus
    } 
        
    return @level + bonus
  end
  
  def shouldCovert()
    dice = Dice.getInstance
    number = dice.nextNumber
    if(number == 6) 
      return true      
    else
      return false
    end
  end

  def incrementLevels(l)
    @level = @level + l
  end
  
  def decrementLevels(l) 
    if((@level - l) < 1)
      @level = 1
    else
      @level = @level - l
    end
  end

  def setPendingBadConsequence(b)
    @pendingBadConsequence = b
  end

  def applyPrize(m) 
    nLevels = m.getLevelsGained
    incrementLevels(nLevels)
    nTreasures = m.getTreasuresGained
    if(nTreasures > 0)
      dealer = CardDealer.getInstance
      
      for i in (0..(nTreasures - 1))
        treasure = dealer.nextTreasure
        @hiddenTreasures << treasure
      end
    end
  end

  def applyBadConsequence(m) 
    badConsequence = m.bc
    nLevels = badConsequence.someLevels
    decrementLevels(nLevels)    
    pendingBad = badConsequence.adjustToFitTreasureLists(@visibleTreasures, @hiddenTreasures)
    setPendingBadConsequence(pendingBad)
  end

  def canMakeTreasureVisible(t) 
    canMakeVisible = true
        
    contOneHand = 0
    @visibleTreasures.each { |tr| 
      if((tr.treasureKind == t.treasureKind) && (t.treasureKind != TreasureKind::ONEHAND)) 
        canMakeVisible = false
      elsif((t.treasureKind == TreasureKind::BOTHHANDS) && (tr.treasureKind == TreasureKind::ONEHAND)) 
        canMakeVisible = false
      elsif((t.treasureKind == TreasureKind::ONEHAND) && (tr.treasureKind == TreasureKind::BOTHHANDS)) 
        canMakeVisible = false
      end
      if(tr.treasureKind == TreasureKind::ONEHAND) 
        contOneHand = contOneHand + 1
      end
    }
        
    if((t.treasureKind == TreasureKind::ONEHAND) && (contOneHand > 1)) 
      canMakeVisible = false
    end
        
    return canMakeVisible
  end

  def howManyVisibleTreasures(tKind)

    nVisibles = 0;
    
    @visibleTreasures.each { |v|
      if(v.treasureKind == tKind)
        nVisibles = nVisibles + 1
      end
    } 
    
    return nVisibles
  end

  def dieIfNoTreasures
        if(@visibleTreasures.empty? && @hiddenTreasures.empty?)
            @death = true
        end 
  end

  def isDead()
    return @death
  end


  def combat(m) 
    combatResult = CombatResult::LOSE
    myLevel = getCombatLevel
    monsterLevel = getOponentLevel(m)     
        
    if(!(canISteal))
      dice = Dice.getInstance
      number = dice.nextNumber
      if(number < 3)
        enemyLevel = @enemy.getCombatLevel
        monsterLevel = monsterLevel + enemyLevel
      end
    end
        
    if(myLevel > monsterLevel)
      applyPrize(m)
      if(@level >= 10)
        combatResult = CombatResult::WINGAME

      else
        combatResult = CombatResult::WIN
      end
      
    elsif(shouldCovert)
      applyBadConsequence(m)
      combatResult = CombatResult::LOSEANDCONVERT
    else
      applyBadConsequence(m)
      combatResult = CombatResult::LOSE
    end
      
        
    return combatResult
  end

  def makeTreasureVisible(t)
   canI = canMakeTreasureVisible(t)
    if(canI) 
      @visibleTreasures << t
      @hiddenTreasures.delete(t)
    end
  end

  def discardVisibleTreasure(t)
    @visibleTreasures.delete(t)
    if((@pendingBadConsequence != nil))
      if(!(@pendingBadConsequence.isEmpty())) 
        @pendingBadConsequence.substractVisibleTreasure(t)
      end
    end
    dieIfNoTreasures
  end

  def discardHiddenTreasure(t)
    @hiddenTreasures.delete(t)
    if((@pendingBadConsequence != nil))
      if(!(@pendingBadConsequence.isEmpty()))
        @pendingBadConsequence.substractHiddenTreasure(t)
      end      
    end
    dieIfNoTreasures
  end

  def validState
    return (((@pendingBadConsequence == nil) || (@pendingBadConsequence.isEmpty)) && (@hiddenTreasures.length <= 4))
  end

  def initTreasures
    dealer = CardDealer.getInstance
    dice = Dice.getInstance
        
    bringToLife
    treasure = dealer.nextTreasure
    @hiddenTreasures << treasure
    number = dice.nextNumber
        
    if(number > 1) 
      treasure = dealer.nextTreasure
      @hiddenTreasures << treasure
    end
        
    if(number == 6) 
      treasure = dealer.nextTreasure
      @hiddenTreasures << treasure
    end
  end

  def stealTreasure
    canI = canISteal()   
    treasure = nil
        
    if(canI)            
      canYou = @enemy.canYouGiveMeATreasure
      if(canYou)
        treasure = @enemy.giveMeATreasure
        @hiddenTreasures << treasure
        haveStolen
      end
    end
    return treasure
  end

  def giveMeATreasure
    pos = rand(@hiddenTreasures.length)
         
    return @hiddenTreasures.at(pos)
  end

  def canYouGiveMeATreasure
    return !(@hiddenTreasures.empty?)
  end

  def haveStolen
    @canISteal = false
  end

  def discardAllTreasures
    visibles = Array.new(@visibleTreasures)
    ocultos = Array.new(@hiddenTreasures)
        
    visibles.each { |t|
      discardVisibleTreasure(t)
    }
    
    ocultos.each { |t|
      discardHiddenTreasure(t)
    }
    
  end
  
  def to_s
    "#{@name}"
  end
   
  private :bringToLife, :incrementLevels, :decrementLevels, :setPendingBadConsequence, :applyPrize, :applyBadConsequence, :canMakeTreasureVisible, :howManyVisibleTreasures, :dieIfNoTreasures, :haveStolen
  
  protected :MAXLEVEL, :getCombatLevel, :getOponentLevel, :shouldCovert

end

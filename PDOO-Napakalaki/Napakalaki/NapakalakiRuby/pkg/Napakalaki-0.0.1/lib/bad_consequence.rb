# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

class BadConsequence
  
  @text
  @someLevels
  @someHiddenTreasures
  @someVisibleTreasures
  @death
  @someSpecificHiddenTreasures
  @someSpecificVisibleTreasures
  
  attr_accessor :text, :someLevels, :someHiddenTreasures, :someVisibleTreasures, :death, :someSpecificHiddenTreasures, :someSpecificVisibleTreasures  
  
  private_class_method:new
   
  def initialize(aText, someLevels, someVisibleTreasures, someHiddenTreasures, someSpecificVisibleTreasures, someSpecificHiddenTreasures, death)
    @text = aText
    @someLevels = someLevels 
    @someVisibleTreasures = someVisibleTreasures
    @someHiddenTreasures = someHiddenTreasures
    @someSpecificVisibleTreasures = someSpecificVisibleTreasures
    @someSpecificHiddenTreasures = someSpecificHiddenTreasures
    @death = death
  end
  
  def self.newLevelNumberOfTreasures(aText, someLevels, someVisibleTreasures, someHiddenTreasures)
    new(aText, someLevels, someVisibleTreasures, someHiddenTreasures, nil, nil, false)   
  end
  
  def self.newLevelSpecificTreasures(aText, someLevels, someSpecificVisibleTreasures, someSpecificHiddenTreasures)
    new(aText, someLevels, nil, nil, someSpecificVisibleTreasures, someSpecificHiddenTreasures, false)      
  end
  
  def self.newDeath(aText)
    new(aText, nil, nil, nil, nil, nil, true)    
  end  
  
  def to_s
    "\nDescripcion: #{@text}"
  end 
  
end

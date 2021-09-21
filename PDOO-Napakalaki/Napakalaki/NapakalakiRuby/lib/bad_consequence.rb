# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "treasure.rb"
require_relative "treasure_kind.rb"


class BadConsequence
    
  @@MAXTREASURES = 10  
  
  attr_accessor :text, :someLevels, :MAXTREASURES 
   
  def initialize(aText, someLevels)
    @text = aText
    @someLevels = someLevels    
  end
 
  def isEmpty
   
  end
  
  
  def substractVisibleTreasure(t)
  
  end
    
   
  def substractHiddenTreasure(t) 
     
  end
    
  def adjustToFitTreasureLists(v, h)
     
  end
  
  def to_s
    "\nDescripcion: #{@text}"
  end 
  
  protected :MAXTREASURES
  
  
end

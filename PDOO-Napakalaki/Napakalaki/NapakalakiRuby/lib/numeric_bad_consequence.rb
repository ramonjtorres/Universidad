# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "bad_consequence.rb"

class NumericBadConsequence < BadConsequence
  
  attr_accessor :someVisibleTreasures, :someHiddenTreasures
  
  def initialize(aText, someLevels, someVisibleTreasures, someHiddenTreasures)
    super(aText, someLevels)     
    @someVisibleTreasures = someVisibleTreasures
    @someHiddenTreasures = someHiddenTreasures   
  end
  
  def isEmpty
    empty = false
    if(@someVisibleTreasures < 1 && @someHiddenTreasures < 1)
      empty = true      
    end
        
    return empty
  end
  
  def substractVisibleTreasure(t)    
    if(@someVisibleTreasures > 0) 
      @someVisibleTreasures = @someVisibleTreasures + 1
    end  
     
  end
    
   
  def substractHiddenTreasure(t) 
     if(@someHiddenTreasures > 0) 
      @someHiddenTreasures = @someHiddenTreasures + 1
    end     
  end
  
  def adjustToFitTreasureLists(v, h)
           
        bc = NumericBadConsequence.new("", 0, 0, 0)
        nHidden = @someHiddenTreasures
        nVisible = @someVisibleTreasures
        
        
        if(@someHiddenTreasures == nil)
          @someHiddenTreasures = 0
        end        
        if(@someVisibleTreasures == nil)
          @someHiddenTreasures = 0
        end  
        
        
        if(nHidden > 0 || nVisible > 0)
         
          if(nHidden > h.length)
            nHidden = h.length
          end
          if(nVisible > v.length)
            nVisible = v.length
          end
          bc = NumericBadConsequence.new("", 0, nVisible, nHidden) 
        end
                
        return bc
  end
end

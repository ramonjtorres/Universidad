# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "bad_consequence"

class SpecificBadConsequence < BadConsequence
  
  attr_accessor :someSpecificVisibleTreasures, :someSpecificHiddenTreasures
  
  def initialize(aText, someLevels, someSpecificVisibleTreasures, someSpecificHiddenTreasures)
    super(aText, someLevels)
    @someSpecificVisibleTreasures = someSpecificVisibleTreasures
    @someSpecificHiddenTreasures = someSpecificHiddenTreasures
  end
  
  def isEmpty
    empty = false
        
    if(@someSpecificVisibleTreasures.empty? && @someSpecificHiddenTreasures.empty?)
      empty = true
    end 
        
    return empty
  end
  
  
  def substractVisibleTreasure(t)      
    if(!(@someSpecificVisibleTreasures.empty?))
      @someSpecificVisibleTreasures.delete(t.treasureKind)
    end
        
  end
    
   
  def substractHiddenTreasure(t)     
    if(!(@someSpecificHiddenTreasures.empty?))
      @someSpecificHiddenTreasures.delete(t.treasureKind)
    end
  end
    
  def adjustToFitTreasureLists(v, h)          
        
        tVisibleT = Array.new
        tHiddenT = Array.new  
        tVisible = Array.new
        tHidden = Array.new
        bc = SpecificBadConsequence.new("", 0, Array.new, Array.new)
       
        if(@someSpecificHiddenTreasures == nil) 
          @someSpecificHiddenTreasures = Array.new
        end
        if(@someSpecificVisibleTreasures == nil) 
          @someSpecificVisibleTreasures = Array.new
        end
              
        if(!(@someSpecificVisibleTreasures.empty?) || !(@someSpecificHiddenTreasures.empty?))
                 
          v.each { |t|
            tVisibleT << t.treasureKind
          }
          
          h.each { |t|
            tHiddenT << t.treasureKind
          }
          
          @someSpecificVisibleTreasures.each { |t|
            if(tVisibleT.index(t) != nil)
              tVisible << t
              tVisibleT.delete_at(tVisibleT.index(t))
            end
          }
          
          @someSpecificHiddenTreasures.each { |t|
            if(tHiddenT.index(t) != nil)
              tHidden << t
              tHiddenT.delete_at(tHiddenT.index(t))
            end
          }         
          bc = SpecificBadConsequence.new("", 0, tVisible, tHidden)         
        end        
        
        return bc
  end
end

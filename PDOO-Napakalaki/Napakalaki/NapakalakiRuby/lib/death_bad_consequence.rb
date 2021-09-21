# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "numeric_bad_consequence.rb"

class DeathBadConsequence < NumericBadConsequence
  
  attr_accessor :death
  
  def initialize(aText, death)
    super(aText, 10, 10, 10)
    @death = death
  end
end

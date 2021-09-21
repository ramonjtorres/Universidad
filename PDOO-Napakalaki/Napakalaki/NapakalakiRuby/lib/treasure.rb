# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require_relative "treasure_kind"

class Treasure  
  @name
  @bonus
  @treasureKind
    
  attr_accessor :name, :bonus, :treasureKind
  
  def initialize(n, bonus, t)
    @name = n
    @bonus = bonus
    @treasureKind = t
  end
  
  def to_s
    "\nNombre: #{@name} \n Bonus: #{@bonus} \n Tipo: #{@treasureKind}"
  end
    
 end

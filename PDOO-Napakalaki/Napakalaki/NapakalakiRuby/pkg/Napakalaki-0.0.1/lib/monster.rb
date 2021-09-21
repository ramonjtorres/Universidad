# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

class Monster
  
  attr_accessor :name, :combatLevel, :bc, :prize
  
  def initialize(name, level, bc, prize)    
    @name = name
    @combatLevel = level
    @bc = bc
    @prize = prize
  end  
  
  def to_s
    "\nNombre del Monstruo: #{@name} \n Nivel de Combate: #{@combatLevel} \n #{bc.to_s} \n #{prize.to_s}"
  end
end

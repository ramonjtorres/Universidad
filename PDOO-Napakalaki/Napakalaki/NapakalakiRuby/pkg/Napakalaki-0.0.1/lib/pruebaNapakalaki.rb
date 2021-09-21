# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.


require_relative "prize.rb"
require_relative "monster.rb"
require_relative "bad_consequence.rb"
require_relative "treasure_kind.rb"

class PruebaNapakalaki  

  @@monster = Array.new

  prize = Prize.new(2, 1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("Pierdes tu armadura visible y otra oculta", 0, [TreasureKind::ARMOR], [TreasureKind::ARMOR])
  @@monster << Monster.new("3 Byakhees de bonanza", 8, badConsequence, prize)
  
  prize = Prize.new(1, 1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("Embobados con el lindo primigenio te descartas de tu casco visible", 0, [TreasureKind::HELMET], nil)
  @@monster << Monster.new("Tenochtitlan", 2, badConsequence, prize)
  
  prize = Prize.new(1, 1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("El primordial bostezo contagioso. Pierdes el calzado visible", 0, [TreasureKind::SHOES], nil)
  @@monster << Monster.new("El sopor de Dunwich", 2, badConsequence, prize)
  
  prize = Prize.new(4, 1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("Te atrapan para llevarte de fiesta y te dejan caer en mitad del vuelo. Descarta 1 mano visible y 1 mano oculta", 0, [TreasureKind::ONEHAND], [TreasureKind::ONEHAND])
  @@monster << Monster.new("Demonios de Magaluf", 2, badConsequence, prize)
  
  #el valor de los tesoros perdidos visibles es 100 para que se pierdan todos
  prize = Prize.new(3,1)
  badConsequence = BadConsequence.newLevelNumberOfTreasures("Pierdes todos tus tesoros visibles", 0, 100, 0)
  @@monster << Monster.new("El gorron en el umbral", 13, badConsequence, prize)
  
  prize = Prize.new(2, 1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("Pierdes la armadura visible", 0, [TreasureKind::ARMOR], nil)
  @@monster << Monster.new("H.P. Munchcraft", 6, badConsequence, prize)
  
  prize = Prize.new(1, 1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("Sientes bichos la bajo la ropa. Descarta la armadura visible", 0, [TreasureKind::ARMOR], nil)
  @@monster << Monster.new("Necrofago", 13, badConsequence, prize)

  prize = Prize.new(3,2)
  badConsequence = BadConsequence.newLevelNumberOfTreasures("Pierdes 5 niveles y 3 tesoros visibles", 5, 3, 0)
  @@monster << Monster.new("El rey de rosado ", 11, badConsequence, prize)

  prize = Prize.new(1,1)
  badConsequence = BadConsequence.newLevelNumberOfTreasures("Toses los pulmones y pierdes 2 niveles", 2, 0, 0)
  @@monster << Monster.new("Flecher", 2, badConsequence, prize)
  
  prize = Prize.new(2,1)
  badConsequence = BadConsequence.newDeath("Estos monstruos resultan bastante superficiales y te aburren mortalmente. Estas muerto")
  @@monster << Monster.new("Los Hondos", 8, badConsequence, prize)
  
  prize = Prize.new(2,1)
  badConsequence = BadConsequence.newLevelNumberOfTreasures("Pierdes 2 niveles y 2 tesoros ocultos", 2, 0, 2)
  @@monster << Monster.new("Semillas Cthulhu", 4, badConsequence, prize)
  
  prize = Prize.new(2,1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("Te intentas escapar pierdes una mano visible", 0, [TreasureKind::ONEHAND], nil)
  @@monster << Monster.new("Dameargo", 1, badConsequence, prize)
  
  prize = Prize.new(2,1)
  badConsequence = BadConsequence.newLevelNumberOfTreasures("Da mucho asquito. Pierdes 3 niveles", 3, 0, 0)
  @@monster << Monster.new("Pollipolipo volante", 3, badConsequence, prize)
  
  prize = Prize.new(3,1)
  badConsequence = BadConsequence.newDeath("No le hace gracia que pronuncien mal su nombre. Estas muerto")
  @@monster << Monster.new("Yskhtihyssg-Goth", 14, badConsequence, prize)
  
  prize = Prize.new(3,1)
  badConsequence = BadConsequence.newDeath("La familia te atrapa. Estas muerto")
  @@monster << Monster.new("Familia Feliz", 1, badConsequence, prize)
  
  prize = Prize.new(2,1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("La quinta directiva primaria te obliga a perder 2 niveles y un tesoro 2 manos visible", 2, [TreasureKind::BOTHHANDS], nil)
  @@monster << Monster.new("Roboggoth", 8, badConsequence, prize)
  
  prize = Prize.new(1,1)
  badConsequence = BadConsequence.newLevelSpecificTreasures("Te asusta en la noche, Pierdes un casco visible", 0, [TreasureKind::HELMET], nil)
  @@monster << Monster.new("El espia sordo", 5, badConsequence, prize)
  
  prize = Prize.new(2,1)
  badConsequence = BadConsequence.newLevelNumberOfTreasures("Menudo susto te llevas. Pierdes 2 niveles y 5 tesoros visibles", 2, 5, 0)
  @@monster << Monster.new("Tongue", 19, badConsequence, prize)
  
  prize = Prize.new(2,1)
  badConsequence = BadConsequence.newLevelNumberOfTreasures("Te asusta en la noche, Pierdes un casco visible", 3, 100, 0)
  @@monster << Monster.new("Bicefalo", 21, badConsequence, prize)
     
  def self.consultaPorNivelCombate()
    mons = Array.new
    @@monster.each { |m|
      if(m.combatLevel > 10)
        mons << m
      end
    }    
    return mons    
  end  
    
  def self.consultaPoPerdidaNivel()
    mons = Array.new
    @@monster.each { |m|
      if(m.bc.levels > 0)
        mons << m
      end
    }    
    return mons    
  end 
  
  def self.consultaPorGananciaNivel()
    mons = Array.new
    @@monster.each { |m|
      if(m.prize.level > 1)
        mons << m
      end
    }    
    return mons    
  end 
  
  def self.consultaPerdidaTesoro(ts)
    mons = Array.new
    yaEncontrado = false
    
    @@monster.each { |m|   
      
      yaEncontrado = false
      if (!m.bc.someSpecificVisibleTreasures.nil?) 
        for i in(0..(m.bc.someSpecificVisibleTreasures.length - 1))
          if(ts == m.bc.someSpecificVisibleTreasures[i] && !yaEncontrado)
            mons << m
            yaEncontrado = true            
          end
        end
      end  
    
      if (!m.bc.someSpecificHiddenTreasures.nil?) 
        for i in(0..(m.bc.someSpecificHiddenTreasures.length - 1))
          if(ts == m.bc.someSpecificHiddenTreasures[i] && !yaEncontrado)
            mons << m
            yaEncontrado = true            
          end
        end
      end  
      
    }    
    
    return mons
  end 
  
  self.consultaPerdidaTesoro(TreasureKind::ONEHAND).each { |m|
    puts m.to_s
  }
  
  self.consultaPerdidaTesoro(TreasureKind::BOTHHANDS).each { |m|
    puts m.to_s
  }
  
  self.consultaPerdidaTesoro(TreasureKind::HELMET).each { |m|
    puts m.to_s
  }
  
  self.consultaPerdidaTesoro(TreasureKind::SHOES).each { |m|
    puts m.to_s
  }
  
  self.consultaPerdidaTesoro(TreasureKind::ARMOR).each { |m|
    puts m.to_s
  }
  
end

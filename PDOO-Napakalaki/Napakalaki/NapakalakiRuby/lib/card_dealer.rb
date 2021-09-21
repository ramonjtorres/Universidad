# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

require "singleton"
require_relative "prize.rb"
require_relative "monster.rb"
require_relative "bad_consequence.rb"
require_relative "treasure.rb"
require_relative "treasure_kind.rb"
require_relative "cultist.rb"
require_relative "specific_bad_consequence.rb"
require_relative "numeric_bad_consequence.rb"
require_relative "death_bad_consequence.rb"

class CardDealer  
  include Singleton
  
  attr_accessor :usedMonsters, :unusedMonsters, :usedTreasures, :unusedTreasures, :unusedCultists
  
  def initialize
    
    @unusedMonsters = Array.new
    @unusedTreasures = Array.new
    @usedMonsters = Array.new
    @usedTreasures = Array.new
    @unusedCultists = Array.new
  end
  
  def initTreasureCardDeck
    @unusedTreasures << Treasure.new("Si mi amo!", 4, TreasureKind::HELMET)
    @unusedTreasures << Treasure.new("Botas de investigacion", 3, TreasureKind::SHOES)
    @unusedTreasures << Treasure.new("Capucha de Cthulhu", 3, TreasureKind::HELMET)
    @unusedTreasures << Treasure.new("A prueba de babas", 2, TreasureKind::ARMOR)
    @unusedTreasures << Treasure.new("Botas de lluvia acida", 1, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Casco minero", 2, TreasureKind::HELMET)
    @unusedTreasures << Treasure.new("Ametralladora ACME", 4, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Camiseta de la ETSIIT", 1, TreasureKind::HELMET)
    @unusedTreasures << Treasure.new("Clavo de rail ferroviario", 3, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Cuchillo de sushi arcano", 2, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Fez alopodo", 3, TreasureKind::HELMET)
    @unusedTreasures << Treasure.new("Hacha prehistorica", 2, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("El aparato del Pr.Tesla", 4, TreasureKind::ARMOR)
    @unusedTreasures << Treasure.new("Gaita", 4, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Insecticida", 2, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Escopeta de 3 canones", 4, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Garabato mistico", 2, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("La rebeca metalica", 2, TreasureKind::ARMOR)
    @unusedTreasures << Treasure.new("Lanzallamas", 4, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Necro-comicon", 1, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Necronomicon", 5, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Linterna a 2 manos", 3, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Necro-gnomicon", 2, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Necrotelecom", 2, TreasureKind::HELMET)
    @unusedTreasures << Treasure.new("Mazo de los antiguos", 3, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Necro-playboycon", 3, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Porra preternatural", 2, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Shogulador", 1, TreasureKind::BOTHHANDS)
    @unusedTreasures << Treasure.new("Varita de atizamiento", 3, TreasureKind::ONEHAND)
    @unusedTreasures << Treasure.new("Tentaculo de pega", 2, TreasureKind::HELMET)
    @unusedTreasures << Treasure.new("Zapato deja-amigos", 1, TreasureKind::SHOES)    
  end
  
  def initMonsterCardDeck
    prize = Prize.new(2, 1)
    badConsequence = SpecificBadConsequence.new("Pierdes tu armadura visible y otra oculta", 0, [TreasureKind::ARMOR], [TreasureKind::ARMOR])
    @unusedMonsters << Monster.new("3 Byakhees de bonanza", 8, badConsequence, prize)

    prize = Prize.new(1, 1)
    badConsequence = SpecificBadConsequence.new("Embobados con el lindo primigenio te descartas de tu casco visible", 0, [TreasureKind::HELMET], Array.new)
    @unusedMonsters << Monster.new("Tenochtitlan", 2, badConsequence, prize)

    prize = Prize.new(1, 1)
    badConsequence = SpecificBadConsequence.new("El primordial bostezo contagioso. Pierdes el calzado visible", 0, [TreasureKind::SHOES], Array.new)
    @unusedMonsters << Monster.new("El sopor de Dunwich", 2, badConsequence, prize)

    prize = Prize.new(4, 1)
    badConsequence = SpecificBadConsequence.new("Te atrapan para llevarte de fiesta y te dejan caer en mitad del vuelo. Descarta 1 mano visible y 1 mano oculta", 0, [TreasureKind::ONEHAND], [TreasureKind::ONEHAND])
    @unusedMonsters << Monster.new("Demonios de Magaluf", 2, badConsequence, prize)
    
    prize = Prize.new(3,1)
    badConsequence = NumericBadConsequence.new("Pierdes todos tus tesoros visibles", 0, 100, 0)
    @unusedMonsters << Monster.new("El gorron en el umbral", 13, badConsequence, prize)

    prize = Prize.new(2, 1)
    badConsequence = SpecificBadConsequence.new("Pierdes la armadura visible", 0, [TreasureKind::ARMOR], Array.new)
    @unusedMonsters << Monster.new("H.P. Munchcraft", 6, badConsequence, prize)

    prize = Prize.new(1, 1)
    badConsequence = SpecificBadConsequence.new("Sientes bichos la bajo la ropa. Descarta la armadura visible", 0, [TreasureKind::ARMOR], Array.new)
    @unusedMonsters << Monster.new("Necrofago", 13, badConsequence, prize)

    prize = Prize.new(3,2)
    badConsequence = NumericBadConsequence.new("Pierdes 5 niveles y 3 tesoros visibles", 5, 3, 0)
    @unusedMonsters << Monster.new("El rey de rosado ", 11, badConsequence, prize)

    prize = Prize.new(1,1)
    badConsequence = NumericBadConsequence.new("Toses los pulmones y pierdes 2 niveles", 2, 0, 0)
    @unusedMonsters << Monster.new("Flecher", 2, badConsequence, prize)

    prize = Prize.new(2,1)
    badConsequence = DeathBadConsequence.new("Estos monstruos resultan bastante superficiales y te aburren mortalmente. Estas muerto", true)
    @unusedMonsters << Monster.new("Los Hondos", 8, badConsequence, prize)

    prize = Prize.new(2,1)
    badConsequence = NumericBadConsequence.new("Pierdes 2 niveles y 2 tesoros ocultos", 2, 0, 2)
    @unusedMonsters << Monster.new("Semillas Cthulhu", 4, badConsequence, prize)

    prize = Prize.new(2,1)
    badConsequence = SpecificBadConsequence.new("Te intentas escapar pierdes una mano visible", 0, [TreasureKind::ONEHAND], Array.new)
    @unusedMonsters << Monster.new("Dameargo", 1, badConsequence, prize)

    prize = Prize.new(2,1)
    badConsequence = NumericBadConsequence.new("Da mucho asquito. Pierdes 3 niveles", 3, 0, 0)
    @unusedMonsters << Monster.new("Pollipolipo volante", 3, badConsequence, prize)

    prize = Prize.new(3,1)
    badConsequence = DeathBadConsequence.new("No le hace gracia que pronuncien mal su nombre. Estas muerto", true)
    @unusedMonsters << Monster.new("Yskhtihyssg-Goth", 14, badConsequence, prize)

    prize = Prize.new(3,1)
    badConsequence = DeathBadConsequence.new("La familia te atrapa. Estas muerto", true)
    @unusedMonsters << Monster.new("Familia Feliz", 1, badConsequence, prize)

    prize = Prize.new(2,1)
    badConsequence = SpecificBadConsequence.new("La quinta directiva primaria te obliga a perder 2 niveles y un tesoro 2 manos visible", 2, [TreasureKind::BOTHHANDS], Array.new)
    @unusedMonsters << Monster.new("Roboggoth", 8, badConsequence, prize)

    prize = Prize.new(1,1)
    badConsequence = SpecificBadConsequence.new("Te asusta en la noche, Pierdes un casco visible", 0, [TreasureKind::HELMET], Array.new)
    @unusedMonsters << Monster.new("El espia sordo", 5, badConsequence, prize)

    prize = Prize.new(2,1)
    badConsequence = NumericBadConsequence.new("Menudo susto te llevas. Pierdes 2 niveles y 5 tesoros visibles", 2, 5, 0)
    @unusedMonsters << Monster.new("Tongue", 19, badConsequence, prize)

    prize = Prize.new(2,1)
    badConsequence = NumericBadConsequence.new("Te asusta en la noche, Pierdes un casco visible", 3, 10, 0)
    @unusedMonsters << Monster.new("Bicefalo", 21, badConsequence, prize)
    
    prize = Prize.new(3,1)
    badConsequence = SpecificBadConsequence.new("Pierdes 1 mano visible", 0, [TreasureKind::ONEHAND], Array.new)
    @unusedMonsters << Monster.new("El mal indecible impronunciable", 10, badConsequence, prize, -2)
    
    prize = Prize.new(2,1)
    badConsequence = NumericBadConsequence.new("Pierdes tus tesoros visibles. Jajaja.", 0, 10, 0)
    @unusedMonsters << Monster.new("Testigos Oculares", 6, badConsequence, prize, 2)
    
    prize = Prize.new(2,5)
    badConsequence = DeathBadConsequence.new("Hoy no es tu dia de suerte. Mueres.", true)
    @unusedMonsters << Monster.new("El gran cthulhu", 20, badConsequence, prize, 4)
    
    prize = Prize.new(2,1)
    badConsequence = NumericBadConsequence.new("Tu gobierno te recorta 2 niveles.", 2,0,0)
    @unusedMonsters << Monster.new("Serpiente Politico", 8, badConsequence, prize, -2)
    
    prize = Prize.new(1,1)
    badConsequence = SpecificBadConsequence.new("Pierdes tu casco y tu armadura visible. Pierdes tus manos ocultas.", 0, [TreasureKind::ARMOR, TreasureKind::HELMET], [TreasureKind::BOTHHANDS])
    @unusedMonsters << Monster.new("Felpuggoth", 2, badConsequence, prize, 5)
    
    prize = Prize.new(4,2)
    badConsequence = NumericBadConsequence.new("Pierdes 2 niveles.", 2,0,0)
    @unusedMonsters << Monster.new("Shoggoth", 16, badConsequence, prize, -4)
    
    prize = Prize.new(1,1)
    badConsequence = NumericBadConsequence.new("Pintalabios negro. Pierdes 2 niveles.", 2,0,0)
    @unusedMonsters << Monster.new("Lolitagooth", 2, badConsequence, prize, 3)
       
  end
  
  def initCultistCardDeck
    @unusedCultists << Cultist.new("Sectario", 1)
    @unusedCultists << Cultist.new("Sectario", 2)
    @unusedCultists << Cultist.new("Sectario", 1)
    @unusedCultists << Cultist.new("Sectario", 2)
    @unusedCultists << Cultist.new("Sectario", 1)
    @unusedCultists << Cultist.new("Sectario", 1)
  end
  
  def shuffleCultists
    @unusedCultists.shuffle!
  end
  
  def shuffleTreasures
    @unusedTreasures.shuffle!
  end
            
  def shuffleMonsters
    @unusedMonsters.shuffle!
  end
    
  def self.getInstance
    return CardDealer.instance
  end
  
  def nextCultist
    c = @unusedCultists.at(0)
    @unusedCultists.delete_at(0)
    return c
  end
    
  def nextTreasure
    if(@unusedTreasures.empty?)
      @usedTreasures.each { |tr|
        @unusedTreasures << tr
      }      
      @usedTreasures.clear
      shuffleTreasures
    end
    t = @unusedTreasures.at(@unusedTreasures.length - 1)
    @unusedTreasures.delete_at(@unusedTreasures.length - 1)
    return t
  end
            
  def nextMonster        
    if(@unusedMonsters.empty?)
      @usedMonsters.each { |mo|
        @unusedMonsters << mo
      }      
      @usedMonsters.clear
      shuffleMonsters
    end
    m = @unusedMonsters.at(@unusedMonsters.length - 1)
    @unusedMonsters.delete_at(@unusedMonsters.length - 1)
    return m
  end
            
  def giveTreasureBack(t)
    @usedTreasures << t
  end
            
  def giveMonsterBack(m)
    @usedMonsters << m
  end
            
  def initCards
        initMonsterCardDeck
        initTreasureCardDeck
        initCultistCardDeck
        
        shuffleMonsters
        shuffleTreasures
        shuffleCultists
  end
    
   private :initTreasureCardDeck, :initMonsterCardDeck, :initCultistCardDeck, :shuffleTreasures, :shuffleMonsters, :shuffleCultists
   
end

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package NapakalakiGame;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;

/**
 *
 * @author ramonjtorres
 */
public class CardDealer {
       
    private static final CardDealer instance = new CardDealer();
    private ArrayList<Monster>unusedMonsters=new ArrayList();
    private ArrayList<Monster>usedMonsters=new ArrayList();
    private ArrayList<Treasure>unusedTreasures=new ArrayList();
    private ArrayList<Treasure>usedTreasures=new ArrayList();
    private ArrayList<Cultist>unusedCultist=new ArrayList();

    private CardDealer(){}
    
    private void initTreasureCardDeck(){
    
        Treasure t = new Treasure("¡Sí mi amo!",4,TreasureKind.HELMET);
        unusedTreasures.add(t);
        
        t = new Treasure("Botas de investigación",3,TreasureKind.SHOES);
        unusedTreasures.add(t);
        
        t = new Treasure("Capucha de Cthulhu",3,TreasureKind.HELMET);
        unusedTreasures.add(t);
    
        t = new Treasure("A prueba de babas",2,TreasureKind.ARMOR);
        unusedTreasures.add(t);
        
        t = new Treasure("Botas de lluvia ácida",1,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);

        t = new Treasure("Casco minero",2,TreasureKind.HELMET);
        unusedTreasures.add(t);
        
        t = new Treasure("Ametralladora ACME",4,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);
        
        t = new Treasure("Camiseta de la ETSIIT",1,TreasureKind.ARMOR);
        unusedTreasures.add(t);
    
        t = new Treasure("Clavo de rail ferroviario",3,TreasureKind.ONEHAND);
        unusedTreasures.add(t);

        t = new Treasure("Cuchillo de sushi arcano",2,TreasureKind.ONEHAND);
        unusedTreasures.add(t);

        t = new Treasure("Fez alópodo",3,TreasureKind.HELMET);
        unusedTreasures.add(t);

        t = new Treasure("Hacha prehistórica",2,TreasureKind.ONEHAND);
        unusedTreasures.add(t);
        
        t = new Treasure("El aparato del Prof. Tesla",4,TreasureKind.ARMOR);
        unusedTreasures.add(t);

        t = new Treasure("Gaita",4,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);

        t = new Treasure("Insecticida",2,TreasureKind.ONEHAND);
        unusedTreasures.add(t); 
 
        t = new Treasure("Escopeta de 3 cañones",4,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);
        
        t = new Treasure("Garabato místico",2,TreasureKind.ONEHAND);
        unusedTreasures.add(t);

        t = new Treasure("La rebeca metálica",2,TreasureKind.ARMOR);
        unusedTreasures.add(t);

        t = new Treasure("Lanzallamas",4,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);

        t = new Treasure("Necrocomicón",1,TreasureKind.ONEHAND);
        unusedTreasures.add(t);
 
        t = new Treasure("Necronomicón",5,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);

        t = new Treasure("Linterna a dos manos",3,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);

        t = new Treasure("Necrognomicón",2,TreasureKind.ONEHAND);
        unusedTreasures.add(t);

        t = new Treasure("Necrotelecom",2,TreasureKind.HELMET);
        unusedTreasures.add(t);

        t = new Treasure("Mazo de los antiguos",3,TreasureKind.ONEHAND);
        unusedTreasures.add(t);

        t = new Treasure("Necroplayboycón",3,TreasureKind.ONEHAND);
        unusedTreasures.add(t);

        t = new Treasure("Porra preternatural",2,TreasureKind.ONEHAND);
        unusedTreasures.add(t);

        t = new Treasure("Shogulador",1,TreasureKind.BOTHHANDS);
        unusedTreasures.add(t);
        
        t = new Treasure("Varita de atizamineto",3,TreasureKind.ONEHAND);
        unusedTreasures.add(t);
        
        t = new Treasure("Tentáculo de pega",2,TreasureKind.HELMET);
        unusedTreasures.add(t);

        t = new Treasure("Zapato de deja-amigos",1,TreasureKind.SHOES);
        unusedTreasures.add(t);}
    
    private void initMonsterCardDeck(){
       
        BadConsequence badConsequence=new NumericBadConsequence ("Pierdes 5 niveles y 3 tesoros ",5,3,0);
        Prize prize = new Prize(4,2);
        Monster m1 = new Monster("El rey de rosa",13,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Te atrapan para llevarte de fiesta y te dejan caer en mitad del vuelo. Descarta una mano  visible y una mano oculta. ",0,new ArrayList(Arrays.asList(TreasureKind.ONEHAND)), new ArrayList(Arrays.asList(TreasureKind.ONEHAND)));
        prize = new Prize(4,1);
        m1 = new Monster("Demonios de Magaluf",2,prize,badConsequence);

        unusedMonsters.add(m1);
        
       badConsequence = new SpecificBadConsequence("Pierdes tu armadura visible y otra oculta",0,new ArrayList(Arrays.asList(TreasureKind.ARMOR)), new ArrayList(Arrays.asList(TreasureKind.ARMOR)));
        prize = new Prize(2,1);
        m1=new Monster("3 Byakhees de bonanza", 8, prize, badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Embobados con el lindo primigenio te descartas de tu casco visible",0,new ArrayList(Arrays.asList(TreasureKind.HELMET)),null);
        prize = new Prize(4,1);
        m1=new Monster ("Tenochtitlan",2,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("El primordial bostezo contagioso. Pierdes el calzado visible. ",0,new ArrayList(Arrays.asList(TreasureKind.SHOES)),null);
        prize = new Prize(1,1);
        m1=new Monster ("El soport de Dunwich ",2,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Pierdes todos tus tesoros visibles.",0,new ArrayList(Arrays.asList(TreasureKind.HELMET,TreasureKind.BOTHHANDS,TreasureKind.ARMOR,TreasureKind.ONEHAND,TreasureKind.SHOES)),null);
        prize = new Prize(3,1);
        m1=new Monster ("El gorron en el umbral. ",13,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Pierdes la armadura visible",0,new ArrayList(Arrays.asList(TreasureKind.ARMOR)),null);
        prize = new Prize(2,1);
        m1=new Monster ("H.P. Munchcraft ",6,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Sientes bichos bajo la ropa. Descartas la armadura visible. ",0,new ArrayList(Arrays.asList(TreasureKind.ARMOR)),null);
        prize = new Prize(1,1);
        m1=new Monster ("Necrofago",13,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Toses los pulmones y pierdes dos niveles. ",2,null,null);
        prize = new Prize(1,1);
        m1=new Monster ("Flecher",2,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new DeathBadConsequence("Estos monstruos resultan bastantes superficiales y te aburren mortalmente. Estas muerto. ");
        prize = new Prize(2,1);
        m1=new Monster ("Los hondos. ",8,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new NumericBadConsequence("Pierdes dos niveles y dos tesoros ocultos. ",2,0,2);
        prize = new Prize(2,1);
        m1=new Monster ("Semillas Cthulhu",4,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Te intentas escaquear. Pierdes una mano visible. ",0,new ArrayList(Arrays.asList(TreasureKind.ONEHAND)),null);
        prize = new Prize(2,1);
        m1=new Monster ("Dameargo",1,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new NumericBadConsequence("Da mucho asquito. Pierdes tres niveles. ",3,0,0);
        prize = new Prize(2,1);
        m1=new Monster ("Pollipolipo volante. ",3,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new DeathBadConsequence("No le hace gracia que pronuncies mal su nombre. Estas muerto.");
        prize = new Prize(3,1);
        m1=new Monster ("Yskhtihyssg-Goth",14,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new DeathBadConsequence("La familia te atrapa. Estas muerto.");
        prize = new Prize(3,1);
        m1=new Monster ("La familia feliz. ",1,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("La quinta directiva primaria te obliga a perder dos niveles y un tesoro de dos manos visible",2,new ArrayList(Arrays.asList(TreasureKind.BOTHHANDS)),null);
        prize = new Prize(2,1);
        m1=new Monster ("Roboggoth",8,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new SpecificBadConsequence("Te asusta en la noche. Pierdes un casco visible.",0,new ArrayList(Arrays.asList(TreasureKind.HELMET)),null);
        prize = new Prize(1,1);
        m1=new Monster ("El espia sordo",5,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new NumericBadConsequence("Menudo susto te llevas. Pierdes dos niveles y 5 tesoros visibles. ",2,5,0);
        prize = new Prize(2,1);
        m1=new Monster ("Tongue ",19,prize,badConsequence);
        unusedMonsters.add(m1);
        
        badConsequence = new NumericBadConsequence("Pierdes una mano visible.",0,1,0);
        prize = new Prize(3,1);
        m1=new Monster ("El mal indecible impronunciable",10,prize,badConsequence,-2);
        unusedMonsters.add(m1);
        
        badConsequence = new NumericBadConsequence("Pierdes tus manos visibles jajaja.",0,5,0);
        prize = new Prize(2,1);
        m1=new Monster ("Testigos oculares",6,prize,badConsequence,2);
        unusedMonsters.add(m1);
        
        badConsequence = new DeathBadConsequence("Hoy no es tu dia de suerte, mueres.");
        prize = new Prize(2,5);
        m1=new Monster ("El gran chtulhu",20,prize,badConsequence,4);
        unusedMonsters.add(m1);
        
        badConsequence = new NumericBadConsequence("Tu gobierno te recorta 2 niveles",2,0,0);
        prize = new Prize(2,1);
        m1=new Monster ("Serpiente politico.",8,prize,badConsequence,-2);
        unusedMonsters.add(m1);
        
        ArrayList<TreasureKind> visi = new ArrayList(Arrays.asList(TreasureKind.HELMET,TreasureKind.ARMOR));
        ArrayList<TreasureKind> nvisi = new ArrayList(Arrays.asList(TreasureKind.HELMET,TreasureKind.ARMOR,TreasureKind.BOTHHANDS,TreasureKind.ONEHAND,TreasureKind.SHOES));
        badConsequence = new SpecificBadConsequence("Pierdes tu casco y tu armadura visible. Pierdes tus manos ocultas",0,visi,nvisi);
        prize = new Prize(1,1);
        m1=new Monster ("Felpuggoth",2,prize,badConsequence,5);
        unusedMonsters.add(m1);
                
        badConsequence = new NumericBadConsequence("Pierdes  2 niveles",2,0,0);
        prize = new Prize(4,2);
        m1=new Monster ("Shoggoth",16,prize,badConsequence,-4);
        unusedMonsters.add(m1);
                
        badConsequence = new NumericBadConsequence("Pintalabios negro. Pierdes 2 niveles",2,0,0);
        prize = new Prize(1,1);
        m1=new Monster ("Lolitagooth",2,prize,badConsequence,3);
        unusedMonsters.add(m1);
        
    
        
    }
    
    private void initCultistCardDeck(){
        
        Cultist tmp = new Cultist("Sectario",1);
        unusedCultist.add(tmp);
        tmp = new Cultist("Sectario",2);
        unusedCultist.add(tmp);
        tmp = new Cultist("Sectario",1);
        unusedCultist.add(tmp);
        tmp = new Cultist("Sectario",2);
        unusedCultist.add(tmp);
        tmp = new Cultist("Sectario",1);
        unusedCultist.add(tmp);
        tmp = new Cultist("Sectario",1);
        unusedCultist.add(tmp); 
    
    }
    
    private void shuffleCultists(){
        Collections.shuffle(unusedCultist);
    }
    
    public Cultist nextCultist(){
    
    if(unusedCultist.isEmpty())
        initCultistCardDeck();
       
    shuffleCultists();
    
    Cultist devolver = unusedCultist.get(0);
    unusedCultist.remove(0);
    
    return devolver;
    }
    
    private void shuffleTreasures(){
        Collections.shuffle(unusedTreasures);
    }
    
    private void shuffleMonsters(){
        Collections.shuffle(unusedMonsters);
    }
    
    public static CardDealer getInstance(){return instance;}
    
    public Treasure nextTreasure(){
        Treasure devolver=null;
        
        if(this.unusedTreasures.isEmpty()){
            for(Treasure tmp : this.usedTreasures)
                this.unusedTreasures.add(tmp);
            
            this.shuffleTreasures();
            this.usedTreasures.clear();
        }
        
        devolver=this.unusedTreasures.get(0);
        
        this.usedTreasures.add(devolver);
        this.unusedTreasures.remove(devolver);
        
        
    return devolver;

     }
    
    public Monster nextMonster(){      
        
        if(this.unusedMonsters.isEmpty()){
            
            for(Monster tmp : this.usedMonsters)
                this.unusedMonsters.add(tmp);
            
            this.shuffleMonsters();
            this.unusedMonsters.clear();
        }
        
        Monster devolver=this.unusedMonsters.get(0);
        
        this.usedMonsters.add(devolver);
        this.unusedMonsters.remove(devolver);
        
        return devolver;
    }
    
    public void giveTreasureBack(Treasure t){usedTreasures.add(t);}
    
    public void giveMonsterBack(Monster m){usedMonsters.add(m);}
    
    public void initCards(){
        this.initTreasureCardDeck();
        this.shuffleTreasures();
        
        this.initMonsterCardDeck();
        this.shuffleMonsters();
        
        this.initCultistCardDeck();
        this.shuffleCultists();
    }

    @Override
    public String toString() {
        return "CardDealer{" + "unusedMonsters=" + unusedMonsters + ", usedMonsters=" + usedMonsters + ", unusedTreasures=" + unusedTreasures + ", usedTreasures=" + usedTreasures + '}';
    }

    
}

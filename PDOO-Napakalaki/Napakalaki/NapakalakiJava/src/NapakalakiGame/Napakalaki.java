
package NapakalakiGame;

import java.util.ArrayList;
import java.util.Random;

public class Napakalaki {
    
    private static final Napakalaki instance=new Napakalaki();
    private CombatResult result;
    private Player currentPlayer;
    
    private ArrayList<Player>players=new ArrayList();
    private Monster currentMonster;
    private CardDealer dealer;
    
    Napakalaki(){}

    private void initPlayers(ArrayList<String>names){
        
        for(String tmp : names){
            Player aux=new Player(tmp);
            players.add(aux);
        }
    }
    
     private Player nextPlayer(){
       
       int next;
       Player nextplayer;
       
       int num_total = players.size();
       
       if(currentPlayer == null){
       
           Random random = new Random();
           
           next = random.nextInt(num_total);
       }
       
       else{
       
           int next_current = players.indexOf(currentPlayer);
           
           if(next_current == num_total-1){
           
               next = 0;
           }
           
           else{
           
               next = next_current+1;
           }
       }
       
       nextplayer = players.get(next);
       currentPlayer = nextplayer;
       
       return currentPlayer;
   }
    
    private boolean nextTurnAllowed(){
        
        return (this.currentPlayer==null) || (this.currentPlayer.validState()==true);
    }
    
    private void setEnemies(){
      for(Player tmp : this.players){
          
        int indice=(int)(Math.random()*(players.size()-1));
      
        while(indice==players.indexOf(this))
            indice=(int)(Math.random()*(players.size()-1));
      
        tmp.setEnemy(players.get(indice));
       }
    }
    
    public static Napakalaki getInstance(){return instance;}
    
    public CombatResult developCombat(){
        
        CombatResult combat;
        Monster m=this.currentMonster;
        dealer=CardDealer.getInstance();
        
        combat=this.currentPlayer.combat(m);
        dealer.giveMonsterBack(m);
        
        if(combat==CombatResult.LOSEANDCONVERT){
            Cultist tmp;
            tmp=dealer.nextCultist();
            
            CultistPlayer nplayer = new CultistPlayer(currentPlayer,tmp);
            
            int index = players.indexOf(currentPlayer);
            this.players.set(index, currentPlayer);
            this.currentPlayer=nplayer;
        }
        
        return combat;
    }
    
    public void discardVisibleTreasures(ArrayList<Treasure>treasures){
        
        for(Treasure tmp : treasures){
            this.currentPlayer.discardVisibleTreasure(tmp);
            dealer.giveTreasureBack(tmp);
        }
    }
    
    public void discardHiddenTreasures(ArrayList<Treasure>treasures){
    
        for(Treasure tmp : treasures){
            this.currentPlayer.discardHiddenTreasure(tmp);
            dealer.giveTreasureBack(tmp);
        }
    }
    
    public void makeTreasuresVisible(ArrayList<Treasure>treasures){
        
        for(Treasure tmp : treasures){
            this.currentPlayer.makeTreasureVsible(tmp);
        }
    
    }
    
    public void initGame(ArrayList<String>players){

        this.initPlayers(players);
        this.setEnemies();

        dealer = CardDealer.getInstance();
        dealer.initCards();        

        this.nextTurn();
    }
    
    public Player getCurrentPlayer(){return currentPlayer;}
    
    public Monster getCurrentMonster(){return currentMonster;}
   
    public boolean nextTurn(){
        
        boolean stateOK=this.nextTurnAllowed();
        dealer=CardDealer.getInstance();
        
        if(stateOK){
            
            this.currentMonster=dealer.nextMonster();
            this.currentPlayer=this.nextPlayer();
            
            boolean death=this.currentPlayer.isDead();
            
            if(death){
                this.currentPlayer.initTreasures();
            }
        }
    return stateOK;
    }
    
    public boolean endOfGame(CombatResult result){
        
        return this.result==CombatResult.WINGAME;
    
        }

    @Override
    public String toString() {
        return "Napakalaki{" + "result=" + result + ", currentPlayer=" + currentPlayer + ", players=" + players + ", currentMonster=" + currentMonster + ", dealer=" + dealer + '}';
    }
    
}

package NapakalakiGame;


public class CultistPlayer extends Player {
    
    private static int totalCultistPlayer=0;
    private Cultist myCultistCard;
    
    CultistPlayer(Player p,Cultist c){
        super(p);
        myCultistCard=c;
        totalCultistPlayer++;
        isCultist=true;
        
    }
    
    @Override
    protected int getCombatLevel(){
        int aux=super.getCombatLevel();
        aux+=(aux*0.7)+(this.myCultistCard.getGainedLevels() * totalCultistPlayer);
        
    return aux;
    }
    
    @Override
    protected int  getOponentLevel(Monster m){
        return m.getCombatLevelAgainstCultistPlayer();
    }
    
    @Override
    protected boolean shouldConvert(){return false;}
    
    private Treasure giveMeATreasure(){
        Player enem=super.getEnemy();
        int index = (int) (Math.random() * enem.getVisibleTreasures().size());
        
        Treasure aux = enem.getVisibleTreasures().get(index);
        enem.discardVisibleTreasure(aux);        
        
        return aux;}
    
    private boolean canYouGiveMeATreasure(){
        
        Player enem=super.getEnemy();
        
        return enem.getVisibleTreasures().isEmpty();
   }

    public static int getTotalCultistPlayer() {
        return totalCultistPlayer;
    } 
}

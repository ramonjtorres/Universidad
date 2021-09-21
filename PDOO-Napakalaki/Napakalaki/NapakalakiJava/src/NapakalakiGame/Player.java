package NapakalakiGame;
import GUI.Dice;
import java.util.ArrayList;

public class Player {
    private final int MAXLEVEL;
    private String name;
    private int level;
    private boolean dead;
    private boolean canISteal;
    private CardDealer dealer;
    private Dice dice;
    protected boolean isCultist;
    private CombatResult combatResult;
    protected Player enemy;
    private BadConsequence pendingBadConsequence;
    private ArrayList<Treasure>hiddenTreasures=new ArrayList();
    private ArrayList<Treasure>visibleTreasures=new ArrayList();

    protected Player getEnemy() {
        return enemy;
    }
    
    public Player(String name) {
        this.name = name;
        dead=true;
        canISteal=true;
        MAXLEVEL=10;
        level=1;
        isCultist=false;
    }
    
    public Player(Player a){
        MAXLEVEL=a.MAXLEVEL;
        name=a.name;
        level=a.level;
        dead=a.dead;
        canISteal=a.canISteal;
        dealer=a.dealer;
        dice=a.dice;
        combatResult=a.combatResult;
        enemy=a.enemy;
        pendingBadConsequence=a.pendingBadConsequence;
        hiddenTreasures=a.hiddenTreasures;
        visibleTreasures=a.visibleTreasures;
    }

    public boolean IsCultist() {
        return isCultist;
    }

    
    public String getName() {
        return name;
    }

    private void bringToLife(){
       dead=false;
    }
    
    protected  int getOponentLevel(Monster m){
        return m.getCombatLevel();
    }
    
    protected boolean shouldConvert(){
        int aux;
        dice=Dice.getInstance();
        aux=dice.nextNumber();
        
        return aux==6;
    }

    protected int getCombatLevel() {

        int aux=this.level;

        for(Treasure tmp : visibleTreasures){
          aux+=tmp.getBonus();
        }
    return aux;
    }

    private void incrementLevels(int i){
        level+=i;
    }

    private void decrementLevels(int i){
        level-=i;

        if(level<1)
             level=1;
    }

    private void setPendingBadConsequence(BadConsequence b){
        pendingBadConsequence=b;
    }

    private void applyPrize(Monster m){

        int nlevels=m.getLevelsGained();
        this.incrementLevels(nlevels);
        int nTreasures=m.getTreasuresGained();

        if(nTreasures>0){
            CardDealer aux = CardDealer.getInstance();

            for(int i=0;i<nTreasures;i++){
                Treasure treasure = aux.nextTreasure();
                this.hiddenTreasures.add(treasure);
            }

        }
    }

    private void applyBadConsequence(Monster m){

        BadConsequence badconsequence = m.getBadConsequence();

        int nlevels=badconsequence.getLevels();
        this.decrementLevels(nlevels);

        BadConsequence pendingBad = badconsequence.adjustToFitTreasureList(hiddenTreasures, hiddenTreasures);
        this.setPendingBadConsequence(pendingBad);
    }

        public boolean canMakeTreasureVisible(Treasure t) {


          boolean visible = true;
          int contador =0;

          for(int i=0; i<visibleTreasures.size() && visible; i++){
              if(visibleTreasures.get(i).getType() == TreasureKind.BOTHHANDS && t.getType() == TreasureKind.ONEHAND)
                  visible=false;
                  else if(visibleTreasures.get(i).getType() == TreasureKind.ONEHAND && t.getType() == TreasureKind.BOTHHANDS)
                    visible=false;
                      else if(t.getType()!= TreasureKind.ONEHAND && visibleTreasures.get(i).getType() == t.getType())
                        visible=false;
                      if(visibleTreasures.get(i).getType() == TreasureKind.ONEHAND)
                          contador++;
                  }
              if(visible && contador == 2 && t.getType() == TreasureKind.ONEHAND)
                  visible=false;

          return visible;
             }


    private int howManyVisibleTreasures(TreasureKind t){
        int tam=0;

        for(Treasure tmp:visibleTreasures){
            if(tmp.getType()==t)
                tam++;
        }
     return tam;
    }

    private void dieIfNoTreasures(){

        if(this.visibleTreasures.isEmpty()&&this.hiddenTreasures.isEmpty())
        dead=true;
    }

    public boolean isDead() {
        return dead;
    }

    public ArrayList<Treasure> getHiddenTreasures() {
        return hiddenTreasures;
    }

    public ArrayList<Treasure> getVisibleTreasures() {
        return visibleTreasures;
    }

    public CombatResult combat(Monster m){
        CombatResult combat;

        int myLevel=this.getCombatLevel();
        int monsterLevel=getOponentLevel(m);

        if(!this.canISteal()){
            Dice aux= Dice.getInstance();
            int number=aux.nextNumber();

            if(number<3){
                int enemyLevel=this.enemy.getCombatLevel();
                monsterLevel+=enemyLevel;
            }
        }

         if(myLevel>monsterLevel){
             this.applyPrize(m);

             if(this.getLevels()>=this.MAXLEVEL)
                 combat=CombatResult.WINGAME;
             else
                 combat=CombatResult.WIN;

        }else{

             if(this.shouldConvert()){
                 combat=CombatResult.LOSEANDCONVERT;
             
             }else{
                 
                this.applyBadConsequence(m);
                combat=CombatResult.LOSE;
             }
         }

    return combat;
    }

    public void makeTreasureVsible(Treasure t){
        boolean canI=this.canMakeTreasureVisible(t);
        if(canI){
            this.visibleTreasures.add(t);
            this.hiddenTreasures.remove(t);
        }
    }

    public void discardVisibleTreasure(Treasure t){
        this.visibleTreasures.remove(t);

        if(this.pendingBadConsequence!=null && (!this.pendingBadConsequence.isEmpty())){
            this.pendingBadConsequence.substractVisibleTreasure(t);
        }

        this.dieIfNoTreasures();
    }

    public void discardHiddenTreasure(Treasure t){

        this.hiddenTreasures.remove(t);

        if(this.pendingBadConsequence!=null && (!this.pendingBadConsequence.isEmpty())){
            this.pendingBadConsequence.substractHiddenTreasure(t);
        }

        this.dieIfNoTreasures();
    }

    public BadConsequence getPendingBadConsequence() {
        return pendingBadConsequence;
    }

    public boolean validState(){
        return (pendingBadConsequence==null || (pendingBadConsequence.isEmpty()&& (hiddenTreasures.size())<4)  );
    }

    public void initTreasures(){

        int number;
        dealer=CardDealer.getInstance();
        dice=Dice.getInstance();
        this.bringToLife();

        Treasure treasure=dealer.nextTreasure();
        this.hiddenTreasures.add(treasure);

        number=dice.nextNumber();

        if(number==6){
           treasure=dealer.nextTreasure();
           this.hiddenTreasures.add(treasure);

           treasure=dealer.nextTreasure();
           this.hiddenTreasures.add(treasure);
        }

        else if(number>1){
            treasure=dealer.nextTreasure();
            this.hiddenTreasures.add(treasure);
        }
    }

    public int getLevels() {
        return level;
    }

    public Treasure stealTreasure(){
        Treasure devolver=null;
        boolean canI=this.canISteal();

        if(canI){
            boolean canYou = enemy.canYouGiveMeATreasure();

            if(canYou){

                devolver=enemy.giveMeATreasure();
                this.hiddenTreasures.add(devolver);
                this.haveStolen();
            }
        }
        return devolver;
    }

    public void setEnemy(Player enemy) {
        this.enemy = enemy;
    }

    private Treasure giveMeATreasure(){


        int indice = (int)(Math.random() * (this.hiddenTreasures.size()-1));
        Treasure devolver=this.enemy.hiddenTreasures.get(indice);
        this.enemy.hiddenTreasures.remove(indice);
        
        return devolver;
    }

    public boolean canISteal(){return canISteal;}

    private boolean canYouGiveMeATreasure(){

      boolean devolver=( !(hiddenTreasures.isEmpty()) || !(visibleTreasures.isEmpty()) );
    return devolver;
    }

    private void haveStolen(){canISteal=false;}

    public void discardAllTreasures(){

        ArrayList<Treasure>visible_aux=new ArrayList(this.visibleTreasures);
        ArrayList<Treasure>hidden_aux=new ArrayList(this.hiddenTreasures);

        for(Treasure tmp : visible_aux){
            this.discardVisibleTreasure(tmp);
            CardDealer.getInstance().giveTreasureBack(tmp);
        }

        for(Treasure tmp : hidden_aux){
            this.discardHiddenTreasure(tmp);
            CardDealer.getInstance().giveTreasureBack(tmp);
    }
  }
    @Override
    public String toString() {
        return "El nombre del jugador es: " + name + ", su nivel es: " + level;
    }
}

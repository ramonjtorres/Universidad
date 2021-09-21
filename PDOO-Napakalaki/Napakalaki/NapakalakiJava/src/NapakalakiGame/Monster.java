/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package NapakalakiGame;

/**
 *
 * @author ramonjtorres
 */
public class Monster {
    
    private String name;
    private int combatLevel;
    private Prize Prize;
    private BadConsequence BadConsequence;
    private int levelChangeAgainstCultistPlayer;
    
    public Monster(String name, int combatLevel, Prize Prize, BadConsequence BadConsequence) {
       this.name = name;
       this.combatLevel = combatLevel;
       this.Prize = Prize;
       this.BadConsequence = BadConsequence;
       this.levelChangeAgainstCultistPlayer=0;
    }
    public Monster(String name, int combatLevel, Prize Prize, BadConsequence BadConsequence,int IC) {
       this.name = name;
       this.combatLevel = combatLevel;
       this.Prize = Prize;
       this.BadConsequence = BadConsequence;
       this.levelChangeAgainstCultistPlayer=IC;
    }

    public int getLevelChangeAgainstCultistPlayer() {
        return levelChangeAgainstCultistPlayer;
    }
    public int getCombatLevelAgainstCultistPlayer(){
        return this.combatLevel + this.levelChangeAgainstCultistPlayer;
    }
    
    
    
    public String getName() {
        return name;
    }

    public int getCombatLevel() {
        return combatLevel;
    }

    public Prize getPrize() {
        return Prize;
    }
    

    public BadConsequence getBadConsequence() {
        return BadConsequence;
    }
    
    public int getLevelsGained(){return Prize.getLevel();}
    
    public int getTreasuresGained(){return Prize.getTreasures();}
    
    @Override
    public String toString() {
        return "\n"+name + "\nSu Nivel es: " + combatLevel + "\n" + Prize + "\n" + BadConsequence + "\n";
    }
}

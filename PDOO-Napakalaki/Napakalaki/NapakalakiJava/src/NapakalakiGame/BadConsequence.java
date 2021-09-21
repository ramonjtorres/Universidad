
package NapakalakiGame;

import java.util.ArrayList;

public abstract class BadConsequence {
    
    protected static final int MAXTREASURES=5;
    private int level;
    private String texto;

    
    public int getLevels() {
        return level;
    }

    public String getText() {
        return texto;
    }

    public BadConsequence(int level,String texto) {
        this.level = level;
        this.texto = texto;
    }
    
    public abstract boolean isDead();
    
    public abstract boolean isEmpty();
    
    public abstract void substractVisibleTreasure(Treasure t);
    
    public abstract void substractHiddenTreasure(Treasure t);
    
    public abstract BadConsequence adjustToFitTreasureList(ArrayList<Treasure>v,ArrayList<Treasure>h);
        

    @Override
    public String toString() {
        return "BadConsequence " + "level=" + level + ",\ntexto=" + texto  ;
    }

    
}

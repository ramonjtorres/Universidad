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
public class Treasure {
    private String names;
    private int bonus;
    private TreasureKind type;

    public Treasure(String names, int bonus, TreasureKind type) {
        this.names = names;
        this.bonus = bonus;
        this.type=type;
    }

    public String getNames() {
        return names;
    }

    public int getBonus() {
        return bonus;
    }

    public TreasureKind getType() {
        return type;
    }

    @Override
    public String toString() {
        return "Treasure{" + "names=" + names + ", bonus=" + bonus + ", type=" + type + '}';
    }
    
    
    
    
    
}

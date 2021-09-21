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
public class Cultist {
    private String name;
    private int gainedLevels;

    public Cultist(String name, int gainedLevels) {
        this.name = name;
        this.gainedLevels = gainedLevels;
    }

    public String getName() {
        return name;
    }

    public int getGainedLevels() {
        return gainedLevels;
    }
    
}

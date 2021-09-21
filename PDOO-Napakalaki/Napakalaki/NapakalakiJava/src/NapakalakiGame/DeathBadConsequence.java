/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package NapakalakiGame;

public class DeathBadConsequence extends NumericBadConsequence {
    public DeathBadConsequence(String text) {
        super(text,21,MAXTREASURES,MAXTREASURES);
    }

    @Override
    public boolean isDead() {
        return true;
    }
    
    @Override 
    public String toString(){
        return "Estas muerto.";
    }
    
    

    
}

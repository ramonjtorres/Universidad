/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package NapakalakiGame;

import java.util.ArrayList;

public class NumericBadConsequence extends BadConsequence {
    
    private int nVisibleTreasures;
    private int nHiddenTreasures;
    
    public NumericBadConsequence(String text, int levels, int nVisibleTreasures, int nHiddenTreasures) {
        super(levels,text);
        
        this.nVisibleTreasures=nVisibleTreasures;
        this.nVisibleTreasures=nVisibleTreasures;
        
    }
    
    
    public  int getnVisibleTreasures() {
        return nVisibleTreasures;
    }

    public int getnHiddenTreasures() {
        return nHiddenTreasures;
    }
    
    @Override
    public boolean isEmpty(){
        
        boolean devolver=false;
        
        if( nVisibleTreasures==0&&nHiddenTreasures==0)
            devolver=true;
        
        return devolver;
    }
    
    @Override
    public void substractVisibleTreasure(Treasure t){
        
        if(this.nVisibleTreasures>0)
            this.nVisibleTreasures-=1;
        
    }
    
    @Override
    public void substractHiddenTreasure(Treasure t){
        
        if( this.nHiddenTreasures>0)
            this.nHiddenTreasures-=1;
    }
    

    
    @Override
    public BadConsequence adjustToFitTreasureList(ArrayList<Treasure>v,ArrayList<Treasure>h){
        BadConsequence devolver;
        int nVis, nHidd;
        int val1,val2;
        nVis=this.nVisibleTreasures;
        nHidd=this.nVisibleTreasures;
            
        if(nVis<v.size())
            val1=nVis;
        else
           val1=v.size();
            
        if(nHidd<h.size())
           val2=nHidd;
        else
           val2=h.size();
            
        devolver=new NumericBadConsequence(super.getText(),super.getLevels(),val2, val1);
        
    return devolver;
    }

    @Override
    public String toString() {
        return super.toString() + "nVisibleTreasures=" + nVisibleTreasures + ", nHiddenTreasures=" + nHiddenTreasures + '}';
    } 

    @Override
    public boolean isDead() {
        return false;
    }




    
    
    
}

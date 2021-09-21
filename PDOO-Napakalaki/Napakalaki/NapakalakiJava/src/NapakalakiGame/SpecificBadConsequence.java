/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package NapakalakiGame;

import java.util.ArrayList;

/**
 *
 * @author ramonjtorres
 */
public class SpecificBadConsequence extends BadConsequence{
    
    
    private ArrayList<TreasureKind>specificVisibleTreasures=new ArrayList();
    private ArrayList<TreasureKind>specificHiddenTreasures=new ArrayList();
    
    public SpecificBadConsequence(String text, int levels, ArrayList<TreasureKind> tVisible, ArrayList<TreasureKind> tHidden) {
        super(levels,text);
        this.specificHiddenTreasures=tHidden;
        this.specificVisibleTreasures=tVisible;
    }
        
    public ArrayList<TreasureKind> getSpecificHiddenTreasures() {
        return specificHiddenTreasures;
    }

    public ArrayList<TreasureKind> getSpecificVisibleTreasures() {
        return specificVisibleTreasures;
    }
    
    @Override
    public  boolean isEmpty(){
        
        boolean devolver=false;
        
        if(!specificVisibleTreasures.isEmpty()&&!specificHiddenTreasures.isEmpty())
            devolver=true;
        
        return devolver;
    }
    
    @Override
    public BadConsequence adjustToFitTreasureList(ArrayList<Treasure>v,ArrayList<Treasure>h){
        
        BadConsequence devolver;
        ArrayList<TreasureKind>sVis=new ArrayList();
        ArrayList<TreasureKind>sHid = new ArrayList();

        if(this.specificVisibleTreasures!=null)
            sVis= specificVisibleTreasures;
            
        if(this.specificHiddenTreasures!=null)
            sHid = this.specificHiddenTreasures;
            
        ArrayList<TreasureKind>aux1 = new ArrayList();
        ArrayList<TreasureKind>aux2 = new ArrayList();

            
        for(Treasure tmp : v){
            if( sVis.remove(tmp.getType()) )
               aux1.add(tmp.getType());
        }
            
        for(Treasure tmp : h){
            if( sHid.remove(tmp.getType()) )
               aux2.add(tmp.getType());
        }
            
        devolver=new SpecificBadConsequence(getText(), getLevels(), aux1, aux2);
        return devolver;
    }

    @Override
    public void substractVisibleTreasure(Treasure t){
        
        if(!this.specificVisibleTreasures.isEmpty())
            this.specificVisibleTreasures.remove(t.getType());
    }
    
    @Override
    public void substractHiddenTreasure(Treasure t){
        
        if(!this.specificHiddenTreasures.isEmpty())
            this.specificHiddenTreasures.remove(t.getType());
    }

    @Override
    public String toString() {
        return super.toString() + "specificVisibleTreasures=" + specificVisibleTreasures + ", specificHiddenTreasures=" + specificHiddenTreasures + '}';
    }

    @Override
    public boolean isDead() {
        return false;
    }
    
}

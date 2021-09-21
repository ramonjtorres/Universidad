/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import NapakalakiGame.Napakalaki;
import NapakalakiGame.Player;
import NapakalakiGame.Treasure;
import com.sun.imageio.plugins.jpeg.JPEG;
import java.awt.Component;
import java.util.ArrayList;
import javax.swing.JPanel;

/**
 *
 * @author ramonjtorres
 */
public class PlayerView extends javax.swing.JPanel {
    
    Player playerModel;
    Napakalaki napakalakiModel; 
    
    public PlayerView() {
        initComponents();
    }

 
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jScrollPane1 = new javax.swing.JScrollPane();
        jList1 = new javax.swing.JList<>();
        player_name = new javax.swing.JLabel();
        player_level = new javax.swing.JLabel();
        jSeparator2 = new javax.swing.JSeparator();
        cultist_l = new javax.swing.JLabel();
        pendingBadConsequenceView1 = new GUI.pendingBadConsequenceView();
        steal_treasure = new javax.swing.JButton();
        make_visible = new javax.swing.JButton();
        discard_treasure = new javax.swing.JButton();
        discard_all_treasures = new javax.swing.JButton();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jScrollPane2 = new javax.swing.JScrollPane();
        hidden_treasures_panel = new javax.swing.JPanel();
        jScrollPane3 = new javax.swing.JScrollPane();
        visible_treasures_panel = new javax.swing.JPanel();

        jList1.setModel(new javax.swing.AbstractListModel<String>() {
            String[] strings = { "Item 1", "Item 2", "Item 3", "Item 4", "Item 5" };
            public int getSize() { return strings.length; }
            public String getElementAt(int i) { return strings[i]; }
        });
        jScrollPane1.setViewportView(jList1);

        player_name.setText("player_name");

        player_level.setText("player_level");

        cultist_l.setText("cultist");

        steal_treasure.setText("Steal Treasure");
        steal_treasure.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                steal_treasureActionPerformed(evt);
            }
        });

        make_visible.setText("Make treasure visible");
        make_visible.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                make_visibleMouseClicked(evt);
            }
        });
        make_visible.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                make_visibleActionPerformed(evt);
            }
        });

        discard_treasure.setText("Discard treasure");
        discard_treasure.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                discard_treasureActionPerformed(evt);
            }
        });

        discard_all_treasures.setText("Discard all treasures");
        discard_all_treasures.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                discard_all_treasuresActionPerformed(evt);
            }
        });

        jLabel1.setText("HiddenTreasures");

        jLabel2.setText("Visible Treasures ");

        hidden_treasures_panel.setBorder(javax.swing.BorderFactory.createMatteBorder(1, 1, 1, 1, new java.awt.Color(0, 204, 255)));
        hidden_treasures_panel.setAutoscrolls(true);
        hidden_treasures_panel.setCursor(new java.awt.Cursor(java.awt.Cursor.DEFAULT_CURSOR));
        hidden_treasures_panel.setLayout(new java.awt.GridLayout(5, 0));
        jScrollPane2.setViewportView(hidden_treasures_panel);

        visible_treasures_panel.setBorder(javax.swing.BorderFactory.createMatteBorder(1, 1, 1, 1, new java.awt.Color(51, 153, 255)));
        visible_treasures_panel.setAutoscrolls(true);
        visible_treasures_panel.setLayout(new java.awt.GridLayout(5, 0));
        jScrollPane3.setViewportView(visible_treasures_panel);

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addGroup(layout.createSequentialGroup()
                        .addContainerGap()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 354, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addComponent(jScrollPane3, javax.swing.GroupLayout.PREFERRED_SIZE, 347, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(layout.createSequentialGroup()
                                .addGap(18, 18, 18)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                                    .addComponent(discard_all_treasures)
                                    .addComponent(jLabel1)
                                    .addComponent(discard_treasure, javax.swing.GroupLayout.PREFERRED_SIZE, 178, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(layout.createSequentialGroup()
                                        .addGap(469, 469, 469)
                                        .addComponent(jSeparator2))
                                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                        .addComponent(jLabel2)
                                        .addGap(106, 106, 106))
                                    .addGroup(layout.createSequentialGroup()
                                        .addGap(204, 204, 204)
                                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                            .addComponent(steal_treasure, javax.swing.GroupLayout.PREFERRED_SIZE, 183, javax.swing.GroupLayout.PREFERRED_SIZE)
                                            .addComponent(make_visible))
                                        .addGap(0, 0, Short.MAX_VALUE))))))
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addGroup(layout.createSequentialGroup()
                                .addContainerGap()
                                .addComponent(pendingBadConsequenceView1, javax.swing.GroupLayout.PREFERRED_SIZE, 656, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(javax.swing.GroupLayout.Alignment.LEADING, layout.createSequentialGroup()
                                .addGap(80, 80, 80)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(cultist_l, javax.swing.GroupLayout.PREFERRED_SIZE, 508, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addGroup(layout.createSequentialGroup()
                                        .addComponent(player_name, javax.swing.GroupLayout.PREFERRED_SIZE, 134, javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(199, 199, 199)
                                        .addComponent(player_level, javax.swing.GroupLayout.PREFERRED_SIZE, 262, javax.swing.GroupLayout.PREFERRED_SIZE)))))
                        .addGap(78, 78, 78)))
                .addGap(48, 48, 48))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(player_name)
                    .addComponent(player_level, javax.swing.GroupLayout.PREFERRED_SIZE, 36, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(18, 18, 18)
                .addComponent(cultist_l, javax.swing.GroupLayout.PREFERRED_SIZE, 24, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(18, 18, 18)
                .addComponent(pendingBadConsequenceView1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jScrollPane2)
                    .addComponent(jScrollPane3, javax.swing.GroupLayout.DEFAULT_SIZE, 316, Short.MAX_VALUE))
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(jSeparator2, javax.swing.GroupLayout.PREFERRED_SIZE, 9, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(175, 175, 175))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(18, 18, 18)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jLabel1)
                            .addComponent(jLabel2))
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addGap(40, 40, 40)
                                .addComponent(discard_all_treasures))
                            .addGroup(layout.createSequentialGroup()
                                .addGap(30, 30, 30)
                                .addComponent(make_visible)))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(discard_treasure)
                            .addComponent(steal_treasure))
                        .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))))
        );
    }// </editor-fold>//GEN-END:initComponents

    private void discard_treasureActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_discard_treasureActionPerformed
        // TODO add your handling code here:
        setNapakalaki();
        
        ArrayList<Treasure>selechid=getSelectedTreasures(hidden_treasures_panel);
        ArrayList<Treasure>selecvis=getSelectedTreasures(visible_treasures_panel);
        
        napakalakiModel.discardVisibleTreasures(selecvis);
        napakalakiModel.discardHiddenTreasures(selechid);
        
        setPlayer(napakalakiModel.getCurrentPlayer());
        
        
    }//GEN-LAST:event_discard_treasureActionPerformed

    private void make_visibleActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_make_visibleActionPerformed
        // TODO add your handling code here:
        setNapakalaki();
        ArrayList<Treasure>selHidden = getSelectedTreasures(hidden_treasures_panel);
        napakalakiModel.makeTreasuresVisible(selHidden);
        setPlayer(napakalakiModel.getCurrentPlayer());
    }//GEN-LAST:event_make_visibleActionPerformed

    private void make_visibleMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_make_visibleMouseClicked

    }//GEN-LAST:event_make_visibleMouseClicked

    private void discard_all_treasuresActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_discard_all_treasuresActionPerformed
        // TODO add your handling code here:
                setNapakalaki();
        napakalakiModel.getCurrentPlayer().discardAllTreasures();
        
        setPlayer(napakalakiModel.getCurrentPlayer());
    }//GEN-LAST:event_discard_all_treasuresActionPerformed

    private void steal_treasureActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_steal_treasureActionPerformed
        // TODO add your handling code here:
       if(playerModel.canISteal())
       {
           playerModel.stealTreasure();
           steal_treasure.setEnabled(false);
           setNapakalaki();
           setPlayer(Napakalaki.getInstance().getCurrentPlayer());
           repaint();
       }
    }//GEN-LAST:event_steal_treasureActionPerformed
    public void setNapakalaki(){
        this.napakalakiModel=Napakalaki.getInstance();
    }
    
    public void setPlayer(Player playerModel) {
        this.playerModel = playerModel;
        this.player_name.setText(playerModel.getName());
        this.player_level.setText("Tu nivel actual es: "+Integer.toString(playerModel.getLevels()));
        
        if(playerModel.IsCultist())
            this.cultist_l.setText("Este jugador es sectario");
        
        else
            this.cultist_l.setText("Este jugador no es sectario");
        
        fillTreasurePanel(visible_treasures_panel, playerModel.getVisibleTreasures());
        System.out.println(playerModel.getHiddenTreasures());
        fillTreasurePanel(hidden_treasures_panel, playerModel.getHiddenTreasures());
        
       pendingBadConsequenceView1.setpendingBadConsequence(playerModel.getPendingBadConsequence());
       
        repaint();
        revalidate();
    }

    private void fillTreasurePanel (JPanel aPanel, ArrayList<Treasure> aList) {
       
    aPanel.removeAll();
    
    for (Treasure t : aList) {
        TreasureView aTreasureView = new TreasureView();
        aTreasureView.setTreasure (t);
        aTreasureView.setVisible (true);
        aPanel.add (aTreasureView);
    }
    
    aPanel.repaint();
    aPanel.revalidate();
}
    private ArrayList<Treasure> getSelectedTreasures(JPanel aPanel) {

    TreasureView tv;
    ArrayList<Treasure> output = new ArrayList();
    
    for (Component c : aPanel.getComponents()) {
        tv = (TreasureView) c;
        if ( tv.isSelected() )
            output.add ( tv.getTreasure() );
    }
    
    return output;
}
    
    public void disableButtons(){
        this.steal_treasure.setEnabled(false);
        this.make_visible.setEnabled(false);
        this.discard_all_treasures.setEnabled(false);
        this.discard_treasure.setEnabled(false);
        
    }
    public void enableButtons(){
        this.steal_treasure.setEnabled(true);
        this.make_visible.setEnabled(true);
        this.discard_all_treasures.setEnabled(true);
        this.discard_treasure.setEnabled(true);
        
    }
    
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel cultist_l;
    private javax.swing.JButton discard_all_treasures;
    private javax.swing.JButton discard_treasure;
    private javax.swing.JPanel hidden_treasures_panel;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JList<String> jList1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JScrollPane jScrollPane2;
    private javax.swing.JScrollPane jScrollPane3;
    private javax.swing.JSeparator jSeparator2;
    private javax.swing.JButton make_visible;
    private GUI.pendingBadConsequenceView pendingBadConsequenceView1;
    private javax.swing.JLabel player_level;
    private javax.swing.JLabel player_name;
    private javax.swing.JButton steal_treasure;
    private javax.swing.JPanel visible_treasures_panel;
    // End of variables declaration//GEN-END:variables
}

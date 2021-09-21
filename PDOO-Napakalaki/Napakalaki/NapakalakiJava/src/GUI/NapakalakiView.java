
package GUI;

import NapakalakiGame.CombatResult;
import NapakalakiGame.Napakalaki;
import NapakalakiGame.Player;

public class NapakalakiView extends javax.swing.JFrame {
    
    private Napakalaki napakalakiModel;
    
    public NapakalakiView() {
        initComponents();
    }

    public void setNapakalaki(Napakalaki napakalakiModel) {
        this.napakalakiModel = napakalakiModel;
        this.monsterView1.setmonsterModel(this.napakalakiModel.getCurrentMonster());
        this.playerView1.setPlayer(this.napakalakiModel.getCurrentPlayer());
        
        ventana_juego.setVisible(false);
        monsterView1.setVisible(false);
        playerView1.enableButtons();
        next_turn.setEnabled(false);
        combat.setEnabled(false);
        meet_monster.setEnabled(true);
        
        repaint();
        
    }
    
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        playerView1 = new GUI.PlayerView();
        monsterView1 = new GUI.MonsterView();
        meet_monster = new javax.swing.JButton();
        combat = new javax.swing.JButton();
        next_turn = new javax.swing.JButton();
        ventana_juego = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        playerView1.setBorder(javax.swing.BorderFactory.createMatteBorder(1, 1, 1, 1, new java.awt.Color(102, 255, 0)));

        monsterView1.setBorder(javax.swing.BorderFactory.createMatteBorder(1, 1, 1, 1, new java.awt.Color(255, 0, 0)));

        meet_monster.setText("Meet the monster");
        meet_monster.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                meet_monsterActionPerformed(evt);
            }
        });

        combat.setText("Combat");
        combat.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                combatActionPerformed(evt);
            }
        });

        next_turn.setText("Next turn");
        next_turn.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                next_turnActionPerformed(evt);
            }
        });

        ventana_juego.setText("jLabel1");

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGap(176, 176, 176)
                .addComponent(meet_monster)
                .addGap(183, 183, 183)
                .addComponent(combat, javax.swing.GroupLayout.PREFERRED_SIZE, 172, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(243, 243, 243)
                .addComponent(next_turn, javax.swing.GroupLayout.PREFERRED_SIZE, 203, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addContainerGap(391, Short.MAX_VALUE))
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(playerView1, javax.swing.GroupLayout.PREFERRED_SIZE, 771, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(18, 18, 18)
                .addComponent(ventana_juego, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addGap(18, 18, 18)
                .addComponent(monsterView1, javax.swing.GroupLayout.PREFERRED_SIZE, 510, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(17, 17, 17))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addContainerGap()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(monsterView1, javax.swing.GroupLayout.PREFERRED_SIZE, 0, Short.MAX_VALUE)
                            .addComponent(playerView1, javax.swing.GroupLayout.DEFAULT_SIZE, 570, Short.MAX_VALUE))
                        .addGap(44, 44, 44))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(226, 226, 226)
                        .addComponent(ventana_juego, javax.swing.GroupLayout.PREFERRED_SIZE, 167, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)))
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(meet_monster)
                    .addComponent(next_turn)
                    .addComponent(combat))
                .addGap(32, 32, 32))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void meet_monsterActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_meet_monsterActionPerformed
        // TODO add your handling code here:
        
        monsterView1.setVisible(true);
        meet_monster.setEnabled(false);
        combat.setEnabled(true);
        
        playerView1.disableButtons();
    }//GEN-LAST:event_meet_monsterActionPerformed

    private void combatActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_combatActionPerformed
        // TODO add your handling code here:
        CombatResult end;
        String cad="";
        
        end=napakalakiModel.developCombat();
        
        switch(end){
            case WINGAME:
                cad="Has ganado el juego!!!";
                break;
            case LOSE: 
                cad="Has perdido el combate.";
                break;
            case LOSEANDCONVERT:
                cad="Has perdido y te combiertes en sectario";
                break;
            case WIN: 
                cad="Ganaste el combate.";
                break;
        }
        combat.setEnabled(false);
        ventana_juego.setText(cad);
        ventana_juego.setVisible(true);
        playerView1.setPlayer(Napakalaki.getInstance().getCurrentPlayer());
        next_turn.setEnabled(true);
        playerView1.enableButtons();
        repaint();
    }//GEN-LAST:event_combatActionPerformed

    private void next_turnActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_next_turnActionPerformed
        // TODO add your handling code here:
        napakalakiModel=Napakalaki.getInstance();
        boolean aux=napakalakiModel.nextTurn();
        
        if(aux){
            setNapakalaki(Napakalaki.getInstance());
            
        
        }
        else
            ventana_juego.setText("No puedes pasar de turno");
        repaint();
    }//GEN-LAST:event_next_turnActionPerformed
    
    public void showView() {
        this.setVisible(true);
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton combat;
    private javax.swing.JButton meet_monster;
    private GUI.MonsterView monsterView1;
    private javax.swing.JButton next_turn;
    private GUI.PlayerView playerView1;
    private javax.swing.JLabel ventana_juego;
    // End of variables declaration//GEN-END:variables
}

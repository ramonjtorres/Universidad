/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.util.ArrayList;

/**
 *
 * @author ramonjtorres
 */
public class PlayerNamesCapture extends javax.swing.JDialog {

    private ArrayList<String> names = new ArrayList();
    
    public PlayerNamesCapture(java.awt.Frame parent, boolean modal) {
        super(parent, modal);
        initComponents();
        
        this.addWindowListener (new WindowAdapter() {
        @Override
        public void windowClosing (WindowEvent e) {
            System.exit(0);
        }
    
    });
    }
    
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jTextField1 = new javax.swing.JTextField();
        jTextField2 = new javax.swing.JTextField();
        jTextField4 = new javax.swing.JTextField();
        Player1 = new javax.swing.JTextField();
        Player2 = new javax.swing.JTextField();
        Player3 = new javax.swing.JTextField();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();

        jTextField1.setText("jTextField1");

        jTextField2.setText("jTextField2");

        jTextField4.setText("jTextField4");

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);

        Player1.setText("Player1");
        Player1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                Player1MouseClicked(evt);
            }
        });
        Player1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                Player1ActionPerformed(evt);
            }
        });
        Player1.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                Player1KeyPressed(evt);
            }
        });

        Player2.setText("Player2");
        Player2.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                Player2MouseClicked(evt);
            }
        });

        Player3.setText("Player3");
        Player3.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                Player3MouseClicked(evt);
            }
        });
        Player3.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                Player3KeyPressed(evt);
            }
        });

        jLabel1.setText("Player 1");

        jLabel2.setText("Player2");

        jLabel3.setText("Player3");

        jButton1.setText("PLAY");
        jButton1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jButton1MouseClicked(evt);
            }
        });
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });

        jButton2.setText("CANCEL");
        jButton2.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jButton2MouseClicked(evt);
            }
        });
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addContainerGap(46, Short.MAX_VALUE)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                    .addComponent(jLabel3, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addComponent(jLabel2, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addComponent(jLabel1, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.DEFAULT_SIZE, 136, Short.MAX_VALUE)
                    .addComponent(jButton1, javax.swing.GroupLayout.PREFERRED_SIZE, 99, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(48, 48, 48)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addComponent(Player2)
                    .addComponent(Player3)
                    .addComponent(jButton2, javax.swing.GroupLayout.PREFERRED_SIZE, 103, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(Player1))
                .addGap(67, 67, 67))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGap(81, 81, 81)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addComponent(Player1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(4, 4, 4)
                        .addComponent(jLabel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)))
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(Player2, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel2))
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(Player3, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel3))
                .addGap(37, 37, 37)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jButton1)
                    .addComponent(jButton2))
                .addContainerGap(46, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_jButton1ActionPerformed

    private void jButton2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton2ActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_jButton2ActionPerformed

    private void jButton1MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jButton1MouseClicked
        // TODO add your handling code here:
        
        names.add(Player1.getText());
        names.add(Player2.getText());
        names.add(Player3.getText());
        
        this.dispose();

    }//GEN-LAST:event_jButton1MouseClicked

    private void jButton2MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jButton2MouseClicked
        // TODO add your handling code here:        
        System.exit(0);
    }//GEN-LAST:event_jButton2MouseClicked

    private void Player1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_Player1ActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_Player1ActionPerformed

    private void Player3KeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_Player3KeyPressed
        // TODO add your handling code here:
    }//GEN-LAST:event_Player3KeyPressed

    private void Player2MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_Player2MouseClicked
        // TODO add your handling code here:
        Player2.setText("");
        repaint();
    }//GEN-LAST:event_Player2MouseClicked

    private void Player3MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_Player3MouseClicked
        // TODO add your handling code here:
        Player3.setText("");
        repaint();
    }//GEN-LAST:event_Player3MouseClicked

    private void Player1MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_Player1MouseClicked
        // TODO add your handling code here:
        Player1.setText("");
        repaint();
    }//GEN-LAST:event_Player1MouseClicked

    private void Player1KeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_Player1KeyPressed
        // TODO add your handling code here:
    }//GEN-LAST:event_Player1KeyPressed

public ArrayList<String> getNames() {
    this.setVisible(true);
    return names;
}

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JTextField Player1;
    private javax.swing.JTextField Player2;
    private javax.swing.JTextField Player3;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JTextField jTextField1;
    private javax.swing.JTextField jTextField2;
    private javax.swing.JTextField jTextField4;
    // End of variables declaration//GEN-END:variables
}

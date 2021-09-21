class Bonus extends THREE.Object3D {

  constructor (aMaterial) {
    super();

    this.material1 = new THREE.MeshPhongMaterial ({color: 0x58acfa, shininess: 70});
      
    this.material = new THREE.MeshPhongMaterial ({color: 0x9f2ae4, /*specular: 0x60e005,*/ shininess: 70});
      
    this.material.flatShading = true;
    this.material.side = THREE.DoubleSide;
                          
  };
    
  extensionpala(){
      
  }
    
  masdisco(){
      
  }
    
  reduccionpala(){
      
  }
    
  ocultarcampo(){
      
  }
    
  pequedisco(){
      
  }
    
}
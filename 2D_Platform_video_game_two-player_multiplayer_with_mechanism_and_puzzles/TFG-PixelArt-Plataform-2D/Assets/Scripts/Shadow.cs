﻿using UnityEngine;

public class Shadow : MonoBehaviour
{
    /// <summary>
    /// The visual effects when the shadow is captured
    /// </summary>
    [SerializeField] GameObject smokeParticles = null;

    /// <summary>
	/// Speed and radius vision of the shadow
	/// </summary>
	public float visionRadius = 5;
    public float scapeRadius = 3;
    public float speed = 2;

    /// <summary>
	/// Position of the shadow
	/// </summary>
	Vector3 initialPosition;
    Vector3 target;

    /// <summary>
    /// The layer the player game object is on
    /// </summary>
    int playerLayer;

    /// <summary>
    /// Reference to the sprite renderer of the shadow
    /// </summary>
    SpriteRenderer shadowRenderer;

    /// <summary>
    /// It is true when the player touches the shadow, avoids more a collision
    /// </summary>
    bool collisionEnter = false;

    /// <summary>
    /// Variables to flip the shadow
    /// </summary>
    float distanceX = 0;
    bool flipShadow = false;

    /// <summary>
    /// Start is called before the first frame update
    /// </summary>
    void Start()
    {
        if (smokeParticles == null)
        {
            Destroy(this);
            Debug.LogError("Error with Shadow script components " + this);
            return;
        }

        shadowRenderer = GetComponent<SpriteRenderer>();

        //Get the integer representation of the "Player" layer
        playerLayer = LayerMask.NameToLayer("Player");

        //Save the shadow's position
        initialPosition = transform.position;

        LevelManager.Instance.RegisterShadow(this);
    }

    void OnTriggerEnter2D(Collider2D collision)
    {
        //If the collider object isn't on the Player layer, exit. This is more 
        //efficient than string comparisons using Tags
        if (collision.gameObject.layer != playerLayer || collisionEnter)
        {
            return;
        }

        collisionEnter = true;

        //The shadow has been touched by the Player, so instantiate an smokeParticles prefab
        //at this location and rotation and destroy the smokeParticles gameObject when pass 1.5 seconds
        GameObject instantiatedSmoke = Instantiate(smokeParticles, transform.position, transform.rotation);
        Destroy(instantiatedSmoke, 1.5f);

        //Tell audio manager to play orb collection audio
        AudioLevelManager.Instance.PlayShadowCollectionAudio();

        //Tell the game manager that this shadow was collected
        LevelManager.Instance.PlayerCaptureShadow(this);

        //Deactivate this shadow to hide it and prevent further collection
        gameObject.SetActive(false);
    }

    void Update()
    {

        //Save an array of players by the tag
        GameObject[] players = GameObject.FindGameObjectsWithTag("Player");

        //Check that there are 2 players
        if (players.Length == 2)
        {

            //The distance of players's position in axis X is smaller than the position of shadow
            distanceX = Input.GetAxis("Horizontal");

            //If the distance is smaller than the visionRadius, player will be the new target
            float distance = Vector3.Distance(players[0].transform.position, transform.position);
            float distance2 = Vector3.Distance(players[1].transform.position, transform.position);
            if (distance < visionRadius) { target = players[0].transform.position;}
            if (distance2 < visionRadius){ target = players[1].transform.position;}

            //If distances of players are smaller than the scapeRadius, the shadow stop
            if (distance < scapeRadius && distance2 < scapeRadius)
            {
                target = transform.position;
            }

            //If the target is a player
            if (target == players[0].transform.position || target == players[1].transform.position) {

                //If some of the player is not in the scapeRadius, then the shadow can flip to scape
                if (distance > scapeRadius || distance2 > scapeRadius)
                {

                    if (distanceX > 0 && flipShadow)
                    {
                        Flip();
                    }
                    else if (distanceX < 0 && !flipShadow)
                    {
                        Flip();
                    }
                }


                //Move the shadow against the player
                float fixedSpeed = -1 * speed * Time.deltaTime;
                transform.position = Vector3.MoveTowards(transform.position, target, fixedSpeed);
                
            }

            Debug.DrawLine(transform.position, target, Color.white);
        }
    }

    /// <summary>
    /// Show the radius vision of the shadow
    /// </summary>
    void OnDrawGizmos() {

        Gizmos.color = Color.red;
        Gizmos.DrawWireSphere(transform.position, visionRadius);

        Gizmos.color = Color.green;
        Gizmos.DrawWireSphere(transform.position, scapeRadius);
    }

    /// <summary>
    /// Flip the X position of the shadow
    /// </summary>
    void Flip() 
    {
        flipShadow = !flipShadow;
        shadowRenderer.flipX = !shadowRenderer.flipX;
    }
}

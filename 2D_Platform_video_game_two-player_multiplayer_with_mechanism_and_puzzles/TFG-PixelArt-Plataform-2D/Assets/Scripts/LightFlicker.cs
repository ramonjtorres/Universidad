﻿// This script causes the light component of a child object to flicker in a realistic
// fashion. This is used on the wall torches. Since this script is slightly expensive
// and purely cosmetic, it will only run on non-mobile platforms and when it's visible.

/// <summary>
/// The script is based on the one provided by Unity as part of their Standard Assets.
/// </summary>

using UnityEngine;
using UnityEngine.Experimental.Rendering.Universal;

public class LightFlicker : MonoBehaviour
{
    Light2D localLight = null;		//Reference to the light component
    float intensity;                //The collective intensity of the light component
    float offset;			        //An offset so all flickers are different
    bool isVisible = false;         //Indicate if this light is visible

    [SerializeField] float amount = 0f;	    //The amount of light flicker
    [SerializeField] float speed = 0f;		//The speed of the flicker
    
	void Awake()
	{
		//If this is a mobile platform, remove this script
		if(Application.isMobilePlatform)
			Destroy(this);
	}

	void Start()
    {
		//Get a reference to the Light component on the child game object
		localLight = GetComponentInChildren<Light2D>();

        if (localLight == null)
        {
            Debug.LogError("Error with LightFlicker script component " + this);
            Destroy(this);
            return;
        }

        //Record the intensity and pick a random seed number to start
        intensity = localLight.intensity;
        offset = Random.Range(0, 10000);
    }

	void Update ()
	{
        if (!isVisible)
        {
            return;
        }

		//Using perlin noise, determine a random intensity amount
		float amt = Mathf.PerlinNoise(Time.time * speed + offset, Time.time * speed + offset) * amount;
		localLight.intensity = intensity + amt;
	}

    void OnBecameVisible()
    {
        isVisible = true;
    }

    void OnBecameInvisible()
    {
        isVisible = false;
    }
}
